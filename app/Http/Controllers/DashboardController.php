<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {

        $user = auth()->user(); // User
        // $userId = $user->id;
        // $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        // $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

        // $totalPemasukanBulanIni = DB::table('transactions')
        //     ->join('categories', 'transactions.category_id', '=', 'categories.id')
        //     ->where('categories.type', 'pemasukan')
        //     ->where('transactions.user_id', $userId)
        //     ->whereBetween('transactions.date', [$startOfMonth, $endOfMonth])
        //     ->sum('transactions.amount');

        // $totalPengeluaranBulanIni = DB::table('transactions')
        //     ->join('categories', 'transactions.category_id', '=', 'categories.id')
        //     ->where('categories.type', 'pengeluaran')
        //     ->where('transactions.user_id', $userId)
        //     ->whereBetween('transactions.date', [$startOfMonth, $endOfMonth])
        //     ->sum('transactions.amount');

        // $sisaSaldoBulanIni = $totalPemasukanBulanIni - $totalPengeluaranBulanIni;

        $totalPemasukanBulanIni = 1;
        $totalPengeluaranBulanIni = 1;
        $sisaSaldoBulanIni = 1;

        return view('admin.dashboard', compact(
            'totalPemasukanBulanIni',
            'totalPengeluaranBulanIni',
            'sisaSaldoBulanIni'
        ));
    }
}
