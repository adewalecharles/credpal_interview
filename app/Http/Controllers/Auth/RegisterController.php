<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Wallet;
use App\Services\UserService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $data['referrer_code'] = $this->generateRandomString();
        if (Input::hasfile($data['avatar'])) {
            $image = Helper::upload($data['valid_id']);
            $data['valid_id'] = $image;
        }
        $user = '';

        try {
            DB::beginTransaction();
            $user = User::create($data);

            Wallet::create([
                'user_id' => $user->id,
                'balance' => 0
            ]);
           
            if (isset($data['referred_by'])) {
                Helper::fundRefferer($data['referred_by']);
            }

            DB::commit();
           
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('warning', 'sorry an error occured');
        }

    }
}
