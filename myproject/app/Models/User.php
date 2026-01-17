<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Các cột cho phép mass assignment
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'is_active',
    ];

    /**
     * Các cột ẩn khi serialize
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast dữ liệu
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    /* =========================================================
     |  ROLE HELPERS
     ========================================================= */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /* =========================================================
     |  STATUS HELPERS
     ========================================================= */

    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }

    /* =========================================================
     |  QUERY SCOPES
     ========================================================= */

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeUser($query)
    {
        return $query->where('role', 'user');
    }
}
