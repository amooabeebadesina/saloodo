<?php


namespace App\Http\Controllers;


use App\Http\Requests\AuthRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Repositories\contracts\OrderRepositoryInterface;
use App\repositories\contracts\UserRepositoryInterface;
use App\Utils\Error;
use App\Utils\JWTIssuer;
use App\Utils\OrderUtil;
use Exception;

class UserController extends Controller
{
    protected $userRepo, $orderRepo;

    public function __construct(UserRepositoryInterface $userRepo, OrderRepositoryInterface $orderRepo)
    {
        $this->userRepo = $userRepo;
        $this->orderRepo = $orderRepo;
    }

    public function login(AuthRequest $request)
    {
        try {
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
        } catch (Exception $e) {
            return $this->sendFatalErrorResponse($e);
        }
    }

    public function createCustomerOrder(CreateOrderRequest $request)
    {
        try {
            $decodedToken = $this->decodeToken($request->header('authorization'));
            $orderData = [
                'user_id' => $decodedToken->id,
                'amount' => OrderUtil::calculateAmount($request->products),
                'paid' => $request->paid,
                'shipping_address' => $request->shipping_address,
                'products' => OrderUtil::stripProductIds($request->products)
            ];

            $order = $this->orderRepo->create($orderData);
            if (!$order) {
                return $this->sendErrorResponse(Error::ORDER_CREATE);
            }
            return $this->sendSuccessResponse($order);
        } catch (Exception $e) {
            return $this->sendFatalErrorResponse($e);
        }

    }

}