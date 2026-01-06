<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'wallet_balance'];

    protected $hidden = ['password'];

    protected $casts = [
        'is_active' => 'boolean',
        'wallet_balance' => 'decimal:2'
    ];

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function publisher()
    {
        return $this->hasOne(Publisher::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAdvertiser()
    {
        return $this->role === 'advertiser';
    }

    public function isPublisher()
    {
        return $this->role === 'publisher';
    }
}
