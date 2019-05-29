<?php


namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\contracts\OrderRepositoryInterface;
use App\Utils\Error;
use App\Utils\OrderUtil;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    protected $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
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
                'products' => $request->products
            ];

            $order = $this->orderRepo->create($orderData);
            if (!$order) {
                return $this->sendErrorResponse(Error::ORDER_CREATE);
            }
            return $this->sendSuccessResponse($order);
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $this->sendFatalErrorResponse($e);
        }

    }

    public function getOrders(Request $request)
    {
        try {
            $role = $request->auth->role;
            $userId = $request->auth->id;
            if ($role === 'admin') {
                $orders = $this->orderRepo->getAllOrders();
            } else {
                $orders = $this->orderRepo->getCustomerOrders($userId);
            }
            return $this->sendSuccessResponse($orders);
        } catch (Exception $e) {
            return $this->sendFatalErrorResponse($e);
        }
    }


}