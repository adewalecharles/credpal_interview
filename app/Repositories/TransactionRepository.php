<?php

namespace App\Repositories;

use App\Models\Transaction;
use Illuminate\Support\Str;

class TransactionRepository
{
    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function save($user, $sender, $amount)
    {
        $ref = Str::random(10);
        $transaction = new $this->transaction;

        //add money to the reciever
        $initial_balance = $user->wallet->balance;
        $new_balance = $initial_balance + $amount;
        //charge the sender
        $sender_balance = $sender->wallet->balance;
        $sender_final_balance = $sender_balance - $amount;

        $user->wallet()->update([
            'balance' => $new_balance
        ]);

        $sender->wallet()->update([
            'balance' => $sender_final_balance
        ]);

        $transaction = Transaction::create([
            "reference" => $ref,
            "payment_type" => 'transfer',
            "amount" => $amount,
            'initial_balance' => $sender_balance,
            'final_balance' =>  $sender_final_balance,
            'transfer_to' => $user->username,
            'description' => '' . $sender->username . ' sent ' . $amount . ' to ' . $user->username . ' ',
            'user_id' => $sender->id,
            'status' =>  'completed',
        ]);

        return $transaction->fresh();

    }

}
