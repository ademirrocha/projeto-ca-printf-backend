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

    /**
     * #CheckUsersByProps
     *
     * @param CheckUserExistsRequest $request
     * @return JsonResponse
     */
    public function checkUserExists(CheckUserExistsRequest $request)
    {
        $userCheck = $this->userService->checkUserExists($request->all());
        $messages = [];
        if($userCheck['result'] != 'accepted'){
            if(isset($userCheck['errors']['username'])){
                $resource = $this->getMessages->getMessage(null, 
                    $options = [
                        'username' => ['UserUsernameInUse'],
                    ],
                    ['message_and_embed' => true]
                );
                $messages['username'][] = $resource['username'];
            }

            if(isset($userCheck['errors']['email'])){
                $resource = $this->getMessages->getMessage(null, 
                    $options = [
                        'email' => ['UserEmailInUse'],
                    ],
                    ['message_and_embed' => true]
                );
                $messages['email'][] = $resource['email'];
            }

            return response()->json([
                'meta' => ['errors' => $messages]
            ], 
            Response::HTTP_RESERVED);
        }else{
            $message = $this->getMessages->getMessage(null, 
                $options = [
                    'message' => ['CheckInUseSuccess'],
                ],
                ['message_and_embed' => true]
            );
            return response()->json([
                'meta' => ['success' => $message['message']]
            ], 
            Response::HTTP_OK);
        }
    }
}
