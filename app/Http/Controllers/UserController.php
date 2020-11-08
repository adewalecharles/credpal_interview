<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;


class UserController extends Controller
{ 
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->$transactionService = $transactionService;
    }

    public function transferfund(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'amount' => 'integer|min:0'
        ]);

        $data = $request->all();
        
        try {
           $transaction = $this->transactionService->registerTransaction($data);
           return response()->json(['message' => 'money sent!'],201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],422);
        }
    }

}
