<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ResendVerificationRequest;
use App\Http\Requests\Api\Auth\VerificationRequest;
use App\Http\Resources\Api\Users\UserResource;
use App\Services\Auth\LoginService;
use App\Services\Auth\VerificationService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use App\Classes\Functions\GetMessages;

/**
 * Class VerificationController
 *
 * @package App\Http\Controllers\Api\Auth
 */
class VerificationController extends Controller
{
    /**
     * @var ResponseFactory
     */
    private $response;
    /**
     * @var VerificationService
     */
    private $verificationService;
    /**
     * @var LoginService
     */
    private $loginService;

    private $getMessages;

    /**
     * VerificationController constructor.
     *
     * @param ResponseFactory $response
     * @param VerificationService $verificationService
     * @param LoginService $loginService
     */
    public function __construct(ResponseFactory $response, VerificationService $verificationService, LoginService $loginService, GetMessages $getMessages)
    {
        $this->response = $response;
        $this->verificationService = $verificationService;
        $this->loginService = $loginService;
        $this->getMessages = $getMessages;
    }

    /**
     * Check registration and return authenticated user data or an exception if the activation token is invalid
     *
     * @param VerificationRequest $request
     * @return UserResource
     * @throws AuthorizationException
     */
    public function verify(VerificationRequest $request)
    {
        $user = $this->verificationService->verify($request->all());

        if(isset($user['error']) && $user['error'] == 'invalid_user_token' ){
            $message = $this->getMessages->getMessage(
                null, 
                $options = [
                    'error' => ['TokenNotFound']
                ],
                ['message_and_embed' => true]
            );
            return $this->response->json(['meta' => $message], 422);
        }
        
        $token = $user->createToken('userToken')->accessToken;

        $message = $this->getMessages->getMessage(
            $user, 
            $options = [
                'success' => ['UserMailAuthSuccess']
            ],
            ['message_and_embed' => true]
        );

        return (new UserResource($user))->additional([
            'meta' => [
                'success' => $message['success'],
                'token' => $token
            ]
        ]);
    }

    /**
     * Resends verification email
     *
     * @param ResendVerificationRequest $request
     * @return JsonResponse
     */
    public function resend(ResendVerificationRequest $request): JsonResponse
    {
        $resend = $this->verificationService->resend($request->all());

        if(isset($resend['error']) && $resend['error'] == 'UserMailAuthResendFail'){
            $message = $this->getMessages->getMessage(
                $resend['user'] ?? null, 
                $options = [
                    'error' => $resend['error']
                ],
                ['message_and_embed' => true]
            );
        }else{
            $message = $this->getMessages->getMessage(
                $resend['user'] ?? null,
                $options = [
                    'success' => ['MailAuthSend']
                ],
                ['message_and_embed' => true]
            );
        }

        

        return $this->response->json(['meta' => $message]);
    }
}
