<?php

namespace App\Repositories;

use App\Contracts\DataRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @implements DataRepositoryInterface<User>
 */
class UserRepository implements DataRepositoryInterface
{
    /**
     * @return Builder<User>
     */
    public function getQuery(): Builder
    {
        return User::query();
    }

    /**
     * @return Collection<int, User>
     */
    public function getAllRecords(): Collection
    {
        return User::all();
    }

    /**
     * @param  array<string, mixed>  $criteria
     * @return LengthAwarePaginator<User>
     */
    public function searchRecords(array $criteria, int $perPage = 15): LengthAwarePaginator
    {
        return $this->getQuery()->where($criteria)->paginate($perPage);
    }

    public function findRecordById(int $id): Model
    {
        return $this->getQuery()->findOrFail($id);
    }

    public function findRecordByUuid(string $uuid): Model
    {
        return $this->getQuery()->where('uuid', $uuid)->firstOrFail();
    }

    /**
     * @param  array<string, mixed>  $attributes
     * @return User
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
