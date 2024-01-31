<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_account_name',
        'receiver_account_name',
        'amount',
        'reason',
        'fraudulent',
    ];

    public function senderAccount()
    {
        return $this->belongsTo(Wallet::class, 'sender_account_name', 'name');
    }

    public function receiverAccount()
    {
        return $this->belongsTo(Wallet::class, 'receiver_account_name', 'name');
    }

}
