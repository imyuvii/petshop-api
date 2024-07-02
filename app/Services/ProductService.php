<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param  array<string, mixed>  $filters
     * @param  int  $perPage
     * @return LengthAwarePaginator<Product>
     */
    public function getAllProducts(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        return $this->productRepository->searchRecords($filters, $perPage);
    }
}
