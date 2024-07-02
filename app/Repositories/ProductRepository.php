<?php

namespace App\Repositories;

use App\Contracts\DataRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @implements DataRepositoryInterface<Product>
 */
class ProductRepository implements DataRepositoryInterface
{
    /**
     * @return Builder<Product>
     */
    public function getQuery(): Builder
    {
        return Product::query();
    }

    /**
     * @return Collection<int, Product>
     */
    public function getAllRecords(): Collection
    {
        return Product::all();
    }

    /**
     * @param  array<string, mixed>  $criteria
     * @return LengthAwarePaginator<Product>
     */
    public function searchRecords(array $criteria, int $perPage = 15): LengthAwarePaginator
    {
        $query = $this->getQuery()->with('category');

        if (isset($criteria['category'])) {
            $query->whereHas('category', function (Builder $query) use ($criteria) {
                $query->where('uuid', $criteria['category']);
            });
        }

        if (isset($criteria['price'])) {
            $query->where('price', $criteria['price']);
        }

        if (isset($criteria['title'])) {
            $query->where('title', 'like', '%'.$criteria['title'].'%');
        }

        if (isset($criteria['sortBy']) && isset($criteria['desc'])) {
            $query->orderBy($criteria['sortBy'], $criteria['desc'] ? 'desc' : 'asc');
        }

        if (isset($criteria['limit'])) {
            $perPage = $criteria['limit'];
        }

        return $query->paginate($perPage);
    }

    public function findRecordById(int $id): Model
    {
        return $this->getQuery()->with('category')->findOrFail($id);
    }

    public function findRecordByUuid(string $uuid): Model
    {
        return $this->getQuery()->with('category')->where('uuid', $uuid)->firstOrFail();
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @return Product
     */
    public function createRecord(array $attributes): Model
    {
        return $this->getQuery()->create($attributes);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function updateRecordById(array $attributes, int $id): void
    {
        $this->findRecordById($id)->update($attributes);
    }

    public function deleteRecordById(int $id): void
    {
        $this->findRecordById($id)->delete();
    }
}
