<?php


namespace App\Http\Controllers;


use App\Http\Requests\AuthRequest;
use App\repositories\contracts\UserRepositoryInterface;
use App\Utils\Error;
use App\Utils\JWTIssuer;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(AuthRequest $request)
    {
        $user = $this->userRepo->authenticate($request);
        if (!$user) {
            return $this->sendErrorResponse(Error::AUTH, null, 401);
        } else {
            $tokenizer = new JWTIssuer($user);
            $response = [
                'token_data' => $tokenizer->getToken(),
                'meta' => $user
            ];
            return $this->sendSuccessResponse($response);
        }
    }

}