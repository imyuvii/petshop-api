<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     required={"id", "first_name", "last_name", "email"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="first_name", type="string", example="John"),
 *     @OA\Property(property="last_name", type="string", example="Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *     @OA\Property(property="avatar", type="string", nullable=true, example="http://example.com/avatar.jpg"),
 *     @OA\Property(property="address", type="string", example="123 Main St"),
 *     @OA\Property(property="phone_number", type="string", example="+1234567890"),
 *     @OA\Property(property="is_marketing", type="boolean", example=false),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-30T18:25:43.511Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-30T18:25:43.511Z")
 * )
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use HasUUID;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'avatar',
        'address',
        'phone_number',
        'is_marketing',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array<string, string>
     */
    public function getJWTCustomClaims(): array
    {
        return [
            'user_uuid' => $this->uuid,
        ];
    }
}
