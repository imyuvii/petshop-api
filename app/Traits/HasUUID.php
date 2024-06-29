<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUUID
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model): void {
            if (!$model->uuid) {
                $model->setAttribute('uuid', Str::uuid()->toString());
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
