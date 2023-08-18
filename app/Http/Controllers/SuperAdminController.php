<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Company;
use App\Models\User;
use App\Models\Wallets;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    public function index()
    {
        $companyCount = User::where('role', 'Company')->count();
        $employeeCount = User::where('role', 'employee')->count();
        $walletCount = Wallets::count();

        $dailyTransactionsCount = Transactions::whereDate('created_at', today())->count();
        $weeklyTransactionsCount = Transactions::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $monthlyTransactionsCount = Transactions::whereMonth('created_at', now())->count();
        $yearlyTransactionsCount = Transactions::whereYear('created_at', now())->count();

        $data = [
            'companyCount' => $companyCount,
            'employeeCount' => $employeeCount,
            'walletCount' => $walletCount,
            'dailyTransactionsCount' => $dailyTransactionsCount,
            'weeklyTransactionsCount' => $weeklyTransactionsCount,
            'monthlyTransactionsCount' => $monthlyTransactionsCount,
            'yearlyTransactionsCount' => $yearlyTransactionsCount,
        ];

        return Inertia::render('Admin', ['data' => $data]);
    }
}
