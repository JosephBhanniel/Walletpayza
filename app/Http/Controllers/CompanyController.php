<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Wallets;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller

{        

  // Function to load cash into the company's wallet
    public function deposit(Request $request)
    {
        // Validate input
        $request->validate([
            'Wallet_id' => 'required|exists:wallets,id',
            'depositAmount' => 'required|numeric|min:0.01',
        ]);

        // Find the wallet
        $wallet = Wallets::findOrFail($request->input('Wallet_id'));

        // Perform deposit logic
        $wallet->balance += $request->input('depositAmount');
        $wallet->save();  

        // Create wallet transaction records to track the transfer
        Transactions::create([
            'sender_wallet_id' => $wallet->id,
            'receiver_wallet_id' => $wallet->id,
            'amount' => $wallet->balance += $request->input('depositAmount'),
            'transaction_type' => 'deposit',
        ]);

        return redirect()->back()->with('success', 'Money Deposited to Company wallet.');
        
    }
    // Function to transfer money to an employee's wallet
    public function transferToEmployee(Request $request)
    {
        // Validate the amount to be transferred
        $data = $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01|max:10000',
        ]);

        // Get the main wallet for the company
        $id = Auth::user()->id;
        $mainWallet = Wallets::where('user_id', $id)->where('type', 'company')->firstOrFail();

        // Check if the company has sufficient balance for the transfer
        if ($mainWallet->balance < $data['amount']) {
            return redirect()->back()->with('error', 'Insufficient balance in the main wallet.');
        }

        // Get or create the wallet for the employee
        $employeeWallet = Wallets::firstOrCreate(
            ['user_id' => $data['recipient_id'], 'type' => 'employee'],
            ['balance' => 0]
        );

        // Decrease the main wallet balance with the transferred amount
        $mainWallet->decrement('balance', $data['amount']);

        // Increase the employee's wallet balance with the transferred amount
        $employeeWallet->increment('balance', $data['amount']);

        // Create wallet transaction records to track the transfer
        Transactions::create([
            'sender_wallet_id' => $mainWallet->id,
            'receiver_wallet_id' => $employeeWallet->user_id,
            'amount' => $data['amount'],
            'transaction_type' => 'transfer',
        ]);

        return redirect()->back()->with('success', 'Money transferred to employee wallet.');
    }

    public function companySummary($companyId)
    {
        try {
            $company = Wallets::where('id', $companyId)->firstOrFail();

            // Retrieve the total amount in the company's wallet
            $totalAmount = $company->balance;
    
            // Retrieve the number of transactions associated with the company
            $transactionCount = Transactions::where('sender_wallet_id', $companyId)->count();
             
            // Retrieve the count of employees associated with the company
            $employeeCount = User::where('company_id', $companyId)->count();
    
            return [
                'total_amount' => $totalAmount,
                'transaction_count' => $transactionCount,
                'employee_count' => $employeeCount,
            ];
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case when the record is not found
            return [
                'total_amount' => 0,
                'transaction_count' => 0,
                'employee_count' => 0,
            ];
        }
    }

    public function door_bouncer()
    {
        $user_role = Auth::user()->role;
        if($user_role === "Employee"){
            return redirect()->route('login');
        }
    }

    public function index()
    {
        $id = Auth::user()->company_id;

        // Fetch summary data using the company_id
        $summary_data = CompanyController::companySummary($id);

        // Pass the summary data to the view using Inertia
        return Inertia::render('Company', [
            'summary_data' => $summary_data,
        ]);
    }
    
    

}
