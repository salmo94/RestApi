<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    const STATUS_BLOCKED = 9;
    const STATUS_ACTIVE = 10;
    public const USER_STATUSES = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_BLOCKED => 'Blocked',
    ];

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    public const USER_ROLES = [
        self::ROLE_USER,
        self::ROLE_ADMIN,
    ];


    /**
     * @param $password
     * @return void
     */
    public function setPasswordAttribute($password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
