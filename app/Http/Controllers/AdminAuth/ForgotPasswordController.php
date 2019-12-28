<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use App\Models\Admin\User;
use Input;
use Validator;
use Image;
use DB;
use Auth;
use Hash;
use Redirect;
use Mail;

class ForgotPasswordController extends Controller
{
    //Sends Password Reset emails
    use SendsPasswordResetEmails;

    //Shows form to request password reset
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    //Password Broker for Admin Model
    public function broker()
    {
         return Password::broker('users');
    }


    public function sendResetLinkEmail() {
        $validator = Validator::make(Input::all(),
            array(
                'email' => 'required|email'
            )
        );

        if($validator->fails()) {
            return redirect()->route('admin_password/reset')->withErrors($validator)->withInput();

        } else {
           // echo $aa;die;
            $user = User::where('email', '=', Input::get('email'));
            if($user->count()) {
                // Generate a new code and password
                $token = str_random(60);
                $password = str_random(10);

                $user = $user->first();
                $user->password = Hash::make($password);
                $check_data = DB::table('admin_password_resets')->select('*')->where('email','=',Input::get('email'))->first();
                if($check_data){
                   $exeQuery = DB::table('admin_password_resets')->where('id', $check_data->id)->update(array('token' => $token,'updated_at'=>date('Y-m-d h:i:s')));
                }else{
                     $exeQuery = DB::table('admin_password_resets')->insert(
                    ['email' => $user->email, 'token' => $token]);
                }
               
                $site_setting = DB::table('site_settings')->select('*')->first();
                $from_mail = $site_setting->email;
                $to_mail = Input::get('email');
                $subject = "Forgot Password";
                if($exeQuery) {//echo 'hi';die;
                    $content = ['email' => Input::get('email'), 'token' => $token];
                    Mail::send('admin.emails.forgot-password', ['content' => $content], function ($message)use($to_mail,$from_mail,$subject) {
                        $message->from($from_mail, $name = 'Info');
                        $message->to($to_mail, $name = null);
                        $message->subject($subject);
                    });

                    return redirect()->back()->with('success', 'Please check your mail for recover password.');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid email address.');
            }

        }
    }

    public function showResetForm($token) {
        $meta = array('meta_description' => 'Admin Panel', 'meta_keywords' => 'admin, administrator', 'token' => $token);
        $exeQuery = DB::table('admin_password_resets')->where('token', $token);
        if($exeQuery->count()==0) {
            return Redirect::route('admin-login')->with('error', 'Your reset password token is invalid.');
        }else{
            return view('admin.auth.passwords.resetpassword', $meta);
        }
        die;

    }

    public function postResetPassword(Request $request) {
        $token = $request->token;
        $password = $request->password;
        $confirm_password = $request->confirm_password;

        $validator = Validator::make(
            array(
                'password' => $password,
                'confirm_password' => $confirm_password
            ),
            array(
                'password' => 'required',
                'confirm_password' => 'required | same:password',
            ),
            array(
                'confirm_password.same' => 'Password and confirm password not same.',
            )
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $exeQuery = DB::table('admin_password_resets')->where('token', $token);
            if($exeQuery->count()) {
                $getUser = $exeQuery->first();
                $getEmail = $getUser->email;
                $user = User::where('email', '=', $getEmail);
                if($user->count()) {
                    $exeQuery = DB::table('users')->where('email', $getEmail)->update(array('password' => Hash::make($password)));
                    //echo $exeQuery; die;
                    if($exeQuery) {
                        $exeQuery = DB::table('admin_password_resets')->where('token', $token)->update(array('token' => '', 'updated_at'=> date('Y-m-d H:i:s')));
                        return redirect()->route('admin-login')->with('success', 'New password successfully set.');
                    }
                } else {
                    return Redirect::route('admin-login')->with('error', 'We could not reset your password please try again later.');
                }
            } else {
                return Redirect::route('admin-login')->with('error', 'We could not reset your password for invalid token.');
            }
        }
    }
}
