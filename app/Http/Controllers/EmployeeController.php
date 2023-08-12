<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Wallets;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    //

    public function employeeSummary($employeeId)
    {
        try {
            $employee = Wallets::where('user_id', $employeeId)->firstOrFail();
    
            // Retrieve the total amount in the employee's wallet
            $totalAmount = $employee->balance;
    
            // Retrieve the number of transactions associated with the employee
            $transactionCount = Transactions::where('receiver_wallet_id', $employeeId)->count();
             
           
    
            return [
                'total_amount' => $totalAmount,
                'transaction_count' => $transactionCount,
                
            ];
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case when the record is not found
            return [
                'total_amount' => 0,
                'transaction_count' => 0,
                
            ];
        }
    }

    public function index()
    {
        $id = Auth::user()->id;

        // Fetch summary data using the user's ID
        $summary_data = EmployeeController::employeeSummary($id);

        // Pass the summary data to the view using Inertia
        return Inertia::render('Employee', [
            'summary_data' => $summary_data,
        ]);
    }
}
