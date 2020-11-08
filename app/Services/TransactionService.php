<?php
namespace App\Services;

use App\Helpers\Helper;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use Illuminate\Support\Str;
class TransactionService
{

    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function registerTransaction($data)
    {
        $email = $data['email'];
        $amount = $data['amount'];

        $sender = Auth::user();

        $user = User::where('email', $email)->first();
        
        if ($sender->valid_id == null && $amount > 50000) {
            throw new InvalidArgumentException(['error' => 'Sorry you cannot transfer more than #50000, you need to submit a valid ID card if you want to transfer more than that']);
        }
        if ($user == null) {
            throw new InvalidArgumentException(['error' => 'User Does Not Exit']);
        }

        if ($amount > $sender->wallet->balance) {
            throw new InvalidArgumentException(['error' => 'sorry you dont have upto that amount in your wallet']);
        }
        
        if($email == Auth::user()->email){
            throw new InvalidArgumentException(['error' => 'Sorry you can not transfer money to yourself']);
        }
            
        $transaction = $this->transactionRepository->save($user,$sender,$amount);

  
            return $transaction;
        } 

}

