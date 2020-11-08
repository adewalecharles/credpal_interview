<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function getTrans()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return response()->json(['transaction' => $transactions],200);
    }
}
