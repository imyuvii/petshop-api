<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFilterRequest;
use App\Services\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/products",
     *     tags={"Products"},
     *     summary="Get a list of products",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *         description="Page number"
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *         description="Number of items per page"
     *     ),
     *     @OA\Parameter(
     *         name="sortBy",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="Field to sort by"
     *     ),
     *     @OA\Parameter(
     *         name="desc",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer", enum={0, 1}),
     *         description="Sort in descending order: 1 for true, 0 for false"
     *     ),
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="Category UUID to filter by"
     *     ),
     *     @OA\Parameter(
     *         name="price",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *         description="Price to filter by"
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="Title to filter by"
     *     ),
     *     @OA\Response(response="200", description="A list of products"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=500, description="Server Error")
     * )
     */
    public function index(ProductFilterRequest $request): JsonResponse
    {
        $filters = $request->validated();
        $products = $this->productService->getAllProducts($filters);

        return response()->json($products);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/product/{uuid}",
     *     tags={"Products"},
     *     summary="Get a product by Uuid",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="uuid",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="Product UUID"
     *     ),
     *     @OA\Response(response="200", description="A product details"),
     *     @OA\Response(response=500, description="Server Error")
     * )
     */
    public function show(Request $request): JsonResponse
    {
        $product = $this->productService->getProductByUuid($request->uuid);
        return $this->success($product);
    }
}
