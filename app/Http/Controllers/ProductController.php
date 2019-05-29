<?php

namespace App\Http\Controllers;



use App\Http\Requests\CreateProductRequest;
use App\Repositories\contracts\ProductRepositoryInterface;
use App\Utils\Error;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function create(CreateProductRequest $request)
    {
        try {
            $product = $this->productRepo->create($request->all());
            if (!$product) {
                return $this->sendErrorResponse(Error::PRODUCT_CREATE_ERROR, null);
            }
            return $this->sendSuccessResponse($product);
        } catch (\Exception $e) {
            return $this->sendFatalErrorResponse($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $products = $this->productRepo->getAll();
            return $this->sendSuccessResponse($products);
        } catch (\Exception $e) {
            return $this->sendFatalErrorResponse($e);
        }
    }
}