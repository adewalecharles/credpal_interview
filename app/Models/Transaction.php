<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['reference','description','transfer_to','initial_balance','final_balance','user_id','amount','status','payment_type'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
