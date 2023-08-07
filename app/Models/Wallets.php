<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'balance',
        'user_id',
        'type',
    ];

    /**
     * Get the user that owns the wallet.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
