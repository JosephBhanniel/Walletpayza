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
        'company_id',
        'employee_id',
        'amount',
        'transaction_type',
    ];

    /**
     * Get the company that sent the transaction.
     */
    public function sender()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get the employee that received the transaction.
     */
    public function receiver()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
