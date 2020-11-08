<?php

namespace App\Helpers;

use App\Models\User;

class Helper
{
    public static function fundRefferer($data)
    {
        $find_refer = User::where('referrer_code', $data)->first();
 
     $wallet_balance = $find_refer->wallet->balance + 1000;

      $find_refer->wallet()->update([
          'balance' => $wallet_balance
      ]);

        return 'true';
    }

    public static function upload($data)
    {
        $name = time() . '.' . $data->getClientOriginalExtension();
        $destinationPath = storage_path('/images/');
        $data->move($destinationPath, $name);

        $image = '/images/' . $name;

        return $image;
    }

    public static function transferLimit($user)
    {

    }
}