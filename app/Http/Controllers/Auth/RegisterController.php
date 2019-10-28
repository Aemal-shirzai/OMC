<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Account;
use App\Doctor;
use App\NormalUser;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
    protected function redirectTo(){
        return route("profile",Auth::user()->username);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // public function register(){
    //     return request()->all();
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:4','max:255','regex:/^([a-zA-Z]+)([0-9]*)([-_]?)([a-zA-Z0-9]+)$/i','unique:accounts'],
            'registerAs' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:accounts'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data["registerAs"] == 0){ // if the user is trying to register as normal users
            $role = Role::find(2);    // by default add the (normal user) role to the user
            $owner = $role->users()->create([
                'fullName' => $data["fullName"],
                'status' => 1, // by defalut keep the user active 
                'gender' => $data["gender"]
            ]);
        }else{ // if the user is trying to register as doctor
             $owner = Doctor::create([
                'fullName' => $data["fullName"],
                'status' => 0, // by defalut keep the user not active 
                'gender' => $data["gender"]
            ]);
        }

        return $owner->account()->create([ // add data to account table from the account realtionship
            'email' => $data['email'],
            'username' => $data["username"],
            'password' => Hash::make($data['password']),
        ]);
    }
}
