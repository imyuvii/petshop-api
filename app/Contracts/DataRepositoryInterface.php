<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface DataRepositoryInterface
{
    public function getQuery(): Builder;

    public function getAllRecords(): Collection;

    public function searchRecords(array $criteria): Collection;

    public function findRecordById(int $id): Model;

    public function createRecord(array $attributes): Model;

    public function updateRecordById(array $attributes, int $id): void;

    public function deleteRecordById(int $id): void;
}
