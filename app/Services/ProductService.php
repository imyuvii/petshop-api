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
     * @return LengthAwarePaginator<Product>
     */
    public function getAllProducts(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        return $this->productRepository->searchRecords($filters, $perPage);
    }

    public function getProductByUuid(string $uuid): Product
    {
        return $this->productRepository->findRecordByUuid($uuid);
    }
}
