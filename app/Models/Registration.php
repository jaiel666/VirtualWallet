<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Registration extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'registrations';

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }
}
