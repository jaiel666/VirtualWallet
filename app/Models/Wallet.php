<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'balance'];


    public function user()
    {
        return $this->belongsTo(Registration::class, 'user_id');
    }
    public function senderTransactions()
    {
        return $this->hasMany(Transaction::class, 'sender_account_name', 'name');
    }


    public function receiverTransactions()
    {
        return $this->hasMany(Transaction::class, 'receiver_account_name', 'name');
    }

}
