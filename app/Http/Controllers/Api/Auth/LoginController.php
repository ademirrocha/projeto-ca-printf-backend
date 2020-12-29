<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Services\Auth\LoginService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginController
 *
 * @package App\Http\Controllers\Api\Auth
 */
class LoginController extends Controller
{
    
    /**
     * @var LoginService
     */
    private $loginService;


    /**
     * LoginController constructor.
     *
     * @param LoginService $loginService
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Authenticate User
     *
     * @param LoginRequest $request
     * @return UserResource
     * @throws AuthorizationException
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request)
    {

        $user = $this->loginService->login($request->only('email', 'password'));
        
        if(isset($user['meta']['errors']) || isset($user['meta']['error'])){
            return response()->json($user, 422);
        }

        $token = $user->createToken('userToken')->accessToken;
        return (new UserResource($user))->additional(['meta' => ['token' => $token]]);
    }

    /**
     * Deauthorize User
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {

        $request->user()->token()->revoke();

        $resource = $this->getMessages->getMessage(null, 
                $options = [
                    'success' => ['UserLogoutSuccess'],
                ],
                ['message_and_embed' => true]
            );

        return $this->response->json(['meta' => $resource]);
    }
}
