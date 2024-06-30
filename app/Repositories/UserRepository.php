<?php

namespace App\Repositories;

use App\Contracts\DataRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements DataRepositoryInterface
{
    /**
     * Get the query builder for the User model.
     */
    public function getQuery(): Builder
    {
        return User::query();
    }

    /**
     * Retrieve all user records.
     */
    public function getAllRecords(): Collection
    {
        return User::all();
    }

    /**
     * Search for user records based on given criteria.
     */
    public function searchRecords(array $criteria): Collection
    {
        return $this->getQuery()->where($criteria)->get();
    }

    /**
     * Find a user record by ID.
     */
    public function findRecordById(int $id): Model
    {
        return $this->getQuery()->findOrFail($id);
    }

    /**
     * Create a new user record.
     */
    public function createRecord(array $attributes): Model
    {
        return $this->getQuery()->create($attributes);
    }

    /**
     * Update a user record by ID.
     */
    public function updateRecordById(array $attributes, int $id): void
    {
        $this->findRecordById($id)->update($attributes);
    }

    /**
     * Delete a user record by ID.
     */
    public function deleteRecordById(int $id): void
    {
        $this->findRecordById($id)->delete();
    }
}
