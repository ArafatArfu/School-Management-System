<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\TooManyRedirectsException;

class AuthController extends Controller
{
    public function login()
    {
        //dd(Hash::make(12345678));
        if(!empty(Auth::check()))
        {
            return redirect('admin/dashboard');
        }

        return view('auth.login');
    } 
    
    public function AuthLogin(Request $request)
    {
       $remember = !empty($request->remember) ? true : false;
       if(Auth::attempt(['email' => $request->email, 'password' =>$request->password],$remember))
       {
            return redirect('admin/dashboard');
       }
       else
       {
            return redirect()->back()->with('error','Please enter current email and password');
       }
    }

    public function logout(Request $request)
    {  
        Auth::logout();
        return redirect(url('/'));
    }

}
