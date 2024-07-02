<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @template TModel of Model
 */
interface DataRepositoryInterface
{
    /**
     * @return Builder<TModel>
     */
    public function getQuery(): Builder;

    /**
     * @return Collection<int, TModel>
     */
    public function getAllRecords(): Collection;

    /**
     * @param  array<string, mixed>  $criteria
     * @return LengthAwarePaginator<TModel>
     */
    public function searchRecords(array $criteria, int $perPage): LengthAwarePaginator;

    /**
     * @return TModel
     */
    public function findRecordById(int $id): Model;

    /**
     * @return TModel
     */
    public function findRecordByUuid(string $id): Model;

    /**
     * @param  array<string, mixed>  $attributes
     * @return TModel
     */
    public function createRecord(array $attributes): Model;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function updateRecordById(array $attributes, int $id): void;

    public function deleteRecordById(int $id): void;
}
