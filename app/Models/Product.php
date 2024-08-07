<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    use HasUUID;

    protected $fillable = [
        'category_id',
        'title',
        'price',
        'description',
        'metadata',
    ];

    /**
     * @return BelongsTo<Category, Product>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected $hidden = [
        'id',
        'category_id',
    ];

    protected $casts = [
        'metadata' => 'json',
    ];
}
