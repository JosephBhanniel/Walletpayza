<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    // Function to load cash into the company's wallet
    public function loadCash(Request $request, User $company)
    {
        // Validate the amount to be loaded
        $data = $request->validate([
            'amount' => 'required|numeric|min:0.01|max:10000',
        ]);

        // Get or create the main wallet for the company
        $mainWallet = Wallet::firstOrCreate(
            ['user_id' => $company->id, 'type' => 'company'],
            ['balance' => 0]
        );

        // Increase the main wallet balance with the loaded amount
        $mainWallet->increment('balance', $data['amount']);

        // Create a wallet transaction record to track the cash loading
        Transaction::create([
            'receiver_wallet_id' => $mainWallet->id,
            'amount' => $data['amount'],
            'transaction_type' => 'deposit',
        ]);

        return redirect()->back()->with('success', 'Cash loaded into the main wallet.');
    }

    // Function to transfer money to an employee's wallet
    public function transferToEmployee(Request $request, User $company, User $employee)
    {
        // Validate the amount to be transferred
        $data = $request->validate([
            'amount' => 'required|numeric|min:0.01|max:10000',
        ]);

        // Get the main wallet for the company
        $mainWallet = Wallet::where('user_id', $company->id)->where('type', 'company')->firstOrFail();

        // Check if the company has sufficient balance for the transfer
        if ($mainWallet->balance < $data['amount']) {
            return redirect()->back()->with('error', 'Insufficient balance in the main wallet.');
        }

        // Get or create the wallet for the employee
        $employeeWallet = Wallet::firstOrCreate(
            ['user_id' => $employee->id, 'type' => 'employee'],
            ['balance' => 0]
        );

        // Decrease the main wallet balance with the transferred amount
        $mainWallet->decrement('balance', $data['amount']);

        // Increase the employee's wallet balance with the transferred amount
        $employeeWallet->increment('balance', $data['amount']);

        // Create wallet transaction records to track the transfer
        Transaction::create([
            'sender_wallet_id' => $mainWallet->id,
            'receiver_wallet_id' => $employeeWallet->id,
            'amount' => $data['amount'],
            'transaction_type' => 'transfer',
        ]);

        return redirect()->back()->with('success', 'Money transferred to employee wallet.');
    }
}
