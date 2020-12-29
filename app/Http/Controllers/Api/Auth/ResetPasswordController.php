<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Http\Requests\Api\Auth\SendPasswordResetLinkRequest;
use App\Repositories\Users\Interfaces\UserRepositoryInterface;
use App\Services\Auth\PasswordResetService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Classes\Functions\ValidateRequests;
use App\Classes\Functions\GetMessages;

/**
 * Class ForgotPasswordController
 * 
 * @package App\Http\Controllers\Api\Auth
 */
class ResetPasswordController extends Controller
{
    /**
     * @var ResponseFactory
     */
    private $response;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var PasswordResetService
     */
    private $passwordResetService;

    private $validateRequests;
    private $getMessages;

    /**
     * PasswordResetService constructor.
     *
     * @param ResponseFactory $response
     * @param UserRepositoryInterface $userRepository
     * @param PasswordResetService $passwordResetService
     */
    public function __construct(ResponseFactory $response, UserRepositoryInterface $userRepository, PasswordResetService $passwordResetService, ValidateRequests $validateRequests, GetMessages $getMessages)
    {
        $this->response = $response;
        $this->userRepository = $userRepository;
        $this->passwordResetService = $passwordResetService;
        $this->validateRequests = $validateRequests;
        $this->getMessages = $getMessages;
        
    }

    /**
     * Send password reset link
     *
     * @param SendPasswordResetLinkRequest $request
     * @return JsonResponse
     */
    public function sendResetLinkEmail(SendPasswordResetLinkRequest $request): JsonResponse
    {

        $validate = $this->validateRequests->validateRequest($request->all());

        if(isset($validate['error']) && $validate['error'] == true){

            return response()->json([
                'meta' => [
                    'errors' => $validate['errors']
                ]
            ], 422);
        }

        $this->passwordResetService->createAndSendLink($request->all());

        $messages = $this->getMessages->getMessage(null, 
            $options = [
                'message' => ['MailAuthSend']
            ],
            [
                'message_and_embed' => true
            ]
        );

        return $this->response->json(['meta' => ['success' => $messages['message']]]);
    }

    /**
     *
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function reset(ResetPasswordRequest $request): JsonResponse
    {

        $validate = $this->validateRequests->validateRequest($request->all());

        if(isset($validate['error']) && $validate['error'] == true){

            return response()->json([
                'meta' => [
                    'errors' => $validate['errors']
                ]
            ], 422);
        }

        $this->passwordResetService->resetPassword($request->all());

        $messages = $this->getMessages->getMessage(null, 
            $options = [
                'message' => ['UserPasswordUpdateSuccess']
            ],
            [
                'message_and_embed' => true
            ]
        );

        return $this->response->json(['meta' => ['success' => $messages['message']]]);
        
    }
}
