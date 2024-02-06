<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\TooManyRedirectsException;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;
use Illuminate\Support\Str;

class AuthController extends Controller
{

        //login


    public function login()
    {
        //dd(Hash::make(12345678));
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type ==1)
            {
                return redirect('admin/dashboard');
            } 
            else if(Auth::user()->user_type ==2)
            {
                return redirect('teacher/dashboard');
            }  
            else if(Auth::user()->user_type ==3)
            {
                return redirect('student/dashboard');
            }  
            else if(Auth::user()->user_type ==4)
            {
                return redirect('parent/dashboard');
            }
        }

        return view('auth.login');
    } 
    


                //Auth login


    public function AuthLogin(Request $request)
    {
       $remember = !empty($request->remember) ? true : false;
       if(Auth::attempt(['email' => $request->email, 'password' =>$request->password],$remember))
       {
            if(Auth::user()->user_type ==1)
            {
                return redirect('admin/dashboard');
            } 
            else if(Auth::user()->user_type ==2)
            {
                return redirect('teacher/dashboard');
            }  
            else if(Auth::user()->user_type ==3)
            {
                return redirect('student/dashboard');
            }  
            else if(Auth::user()->user_type ==4)
            {
                return redirect('parent/dashboard');
            }

       }
       else
       {
            return redirect()->back()->with('error','Please enter current email and password');
       }
    }




            //Forgot password

    public function forgotpassword(Request $request)
    {
        return view('auth.forgot');
    }




             //Post Forgot Password

    public function PostForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if(!empty($user))
        {
           $user->remember_token= Str::random(30);
           $user->save();

           Mail::to($user->email)->send(new ForgotPasswordMail($user));
           return redirect()->back()->with('success','Please check your email and reset your password');
        }
        else
        {
            return redirect()->back()->with('error','Email Not found in this system');
        }
    }




            //Get Token for reset password

        public function Reset($remember_token)
        {
            $user = User::getTokenSingle($remember_token);
            if(!empty($user))
            {
                $data['user'] = $user;
                return view('auth.reset',$data);
            }
            else
            {
                abort(404);
            }
        }
        


                     //Post Reset Password



        public function PostReset($token, Request $request)
        {
             //check password or cpassword same or not

            if($request->password == $request->cpassword)
            {
                $user = User::getTokenSingle($token);
                $user->password = hash::make($request->password);
                //remember token makes deffrent not a same to first one when change password
                $user->remember_token = Str::random(30);
                $user->save();

                return redirect(url(''))->with('success',"Password successfully reset");
            }
            else
            {
                return redirect()->back()->with('error',"Password and Confirm password does not match");
            }

        }


                     



                    //Logout


        public function logout(Request $request)
        {  
            Auth::logout();
            return redirect(url('/'));
        }
}
  