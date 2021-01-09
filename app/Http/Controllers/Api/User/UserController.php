<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\User\UpdateRequest;
use App\Services\User\UserService;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var userService
     */
    private $userService;


    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
    	$this->userService = $userService;
    }

    public function update(UpdateRequest $request)
    {


    	if (! Hash::check($request->password_old, Auth::user()->password))
    	{
    		
    		return response()->json([
    			'errors' => [
    				'password_old' => ['Senha incorreta']
    			]
    		], Response::HTTP_UNPROCESSABLE_ENTITY);

    	}


    	$user = $this->userService->update($request->all());

    	return new UserResource($user);

    }

}
