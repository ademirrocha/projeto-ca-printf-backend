<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CreateRequest;
use App\Services\User\UserService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Api\User\UserResource;

/**
 * Class RegisterController
 *
 * @package App\Http\Controllers\Api\Auth
 */
class RegisterController extends Controller
{
    
    /**
     * @var UserService
     */
    private $userService;

    /**
     * RegisterController constructor.
     *
     */
    public function __construct(UserService $userService)
    {
        
        $this->userService = $userService;
    }

    
    /**
     * Store a newly created User in storage.
     *
     * @param CreateRequest $request
     */
    //#UserCreate-CaseUse
    public function create(CreateRequest $request)
    {

        $user = $this->userService->create($request->all());

        $token = $user->createToken('userToken')->accessToken;
        return (new UserResource($user))->additional(['meta' => ['token' => $token]]);

    }

    
}