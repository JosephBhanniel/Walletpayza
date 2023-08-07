<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'sender_wallet_id',
        'receiver_wallet_id',
        'type',
    ];

    /**
     * Get the company that sent the transaction.
     */
    public function senderWallet()
    {
        return $this->belongsTo(Wallet::class, 'sender_wallet_id');
    }

    /**
     * Get the receiver wallet of the transaction.
     */
    public function receiverWallet()
    {
        return $this->belongsTo(Wallet::class, 'receiver_wallet_id');
    }
}
