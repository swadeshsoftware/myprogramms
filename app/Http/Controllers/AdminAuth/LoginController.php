<?php
namespace App\Http\Controllers\AdminAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;
use Redirect;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected function guard()
    {
       return Auth::guard('web');
    }
    public function showLoginForm()
    {
       return view('admin.auth.login',['pageTitle'=>'Admin-Login']);
    }

    protected function validator(array $data){
        return  Validator::make(
            $data,
            [
            'email' => 'required | email',
            'password' => 'required'
            ],
            [
            'email.required' => 'Enter email address.',
            'email.email' => 'Enter valid email address.',
            'password.required' => 'Enter password.'
            ]
        );
    }

    public function login(Request $request){
        $validator = $this->validator($request->all())->validate();
        $users = DB::table('users')->select('role')
                ->where('email','=',$request->email)
                ->where('active','=',1)
                ->where('deleted_at',NULL)->first();
        //echo "<pre>";print_r($users);die;
        if($users){
            if($users->role=="admin"){
                $data = [
                    'email' => $request->email,
                    'password' => $request->password,
                    'active' =>1,
                    'role'=>$users->role,
                    'deleted_at' =>NULL
                ];
                $login = Auth::guard('web')->attempt($data);
                if($login){
                    session_start();
                    $_SESSION['loginVerified']=TRUE;
                    return redirect()->route('dashboards.index')->with('success', 'Successfully loggedin.');
                }else{
                    return redirect()->route('admin-login')->with('error', 'Invalid username/password');
                }

            }else{
                return redirect()->route('admin-login')->with('error', 'You Do not have permisssion to login');
            }

        }else{
            return redirect()->route('admin-login')->with('error', 'Invalid username/password');
        }

    }
    public function logout() {
        Auth::guard('web')->logout();
        session_start();
        $_SESSION['loginVerified']=FALSE;
        unset($_SESSION['loginVerified']);
        return redirect()->route('admin-login')->with('success', 'Successfully logged out.');;
    }
}
