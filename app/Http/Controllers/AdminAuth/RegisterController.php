<?php
namespace App\Http\Controllers\AdminAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use Auth;
use DB;
class RegisterController extends Controller
{
    //protected $redirectPath = 'admin_home';

    public function showRegistrationForm()
    {
       // echo "string";die;
        return view('admin.auth.register',['pageTitle'=>'Admin-Signup']);
    }
    public function register(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $create = $this->create($request->all());
        if ($create) {
            return redirect()->route('admin-register')->with('success', 'Successfully registered.');
        } else {
            return redirect()->route('admin-register')->with('error', 'Data not saved.');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => 'required',
                'email' => 'required | email | unique:users',
                'password' => 'required | min:4',
                'password_confirmation' => 'required | same:password'
            ],

            [
                'name.required' => 'Enter full name.',
                'email.required' => 'Enter email address.',
                'email.unique' => 'Email address already registered.',
                'password.required' => 'Enter password.',
                'password_confirmation.required' => 'Enter confirm password.',
                'password_confirmation.same' => 'The password confirmation does not match.'
            ]

        );

    }
    protected function create(array $data)
    {
        //echo "<pre>";print_r($data);die;
        return $id = DB::table('users')->insertGetId(array( 'type'=>1,'role'=>'admin', 'name' => $data['name'],'email' => $data['email'],'password' => bcrypt($data['password']),'remember_token' => $data['_token'],'created_at'=>date('Y-m-d H:i:s')));

    }
    protected function guard()
    {
      // return Auth::guard('web_admin');
    }
}

