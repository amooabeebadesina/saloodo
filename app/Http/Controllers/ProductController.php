<?php

namespace App\Http\Controllers;



use App\Http\Requests\CreateBundleRequest;
use App\Http\Requests\CreateProductRequest;
use App\Repositories\contracts\ProductRepositoryInterface;
use App\Utils\Error;
use App\Utils\OrderUtil;
use Exception;
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
        } catch (Exception $e) {
            return $this->sendFatalErrorResponse($e);
        }
    }

    public function createBundle(CreateBundleRequest $request)
    {
        try {
            $data = [
                'price' => $request->price,
                'name' => $request->name,
                'description' => $request->description,
                'products' => OrderUtil::stripProductIds($request->products)
            ];
            $product = $this->productRepo->createBundle($data);
            if (!$product) {
                return $this->sendErrorResponse(Error::BUNDLE_CREATE_ERROR, null);
            }
            return $this->sendSuccessResponse($product);
        } catch (Exception $e) {
            var_dump($e);
            return $this->sendFatalErrorResponse($e);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $products = $this->productRepo->getAll();
            return $this->sendSuccessResponse($products);
        } catch (Exception $e) {
            return $this->sendFatalErrorResponse($e);
        }
    }

    public function update(CreateProductRequest $request, $id)
    {
        try {
            $product = $this->productRepo->update($id, $request->all());
            if (!$product) {
                return $this->sendErrorResponse(Error::PRODUCT_CREATE_ERROR, null);
            }
            return $this->sendSuccessResponse($product);
        } catch (Exception $e) {
            return $this->sendFatalErrorResponse($e);
        }
    }
}