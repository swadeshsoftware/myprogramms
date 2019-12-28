<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Register;

use DB;
use Input;
use Image;
use Hash;
use Auth;
use Mail;
use File;
use Crypt;
use Session;



class AdministratorController extends Controller
{ 
    public function __construct()
    {
        
    }
    public function index()
    {
        //echo "dibakar";die;
        $user_id = Auth::guard('web')->user()->id;
        $pageTitle = "Administrator";
        $pageName = "Administrator";
        $query = DB::table("users")->select('users.*')->where('type','=','1')->where('users.deleted_at', NULL);
        if (Input::has('search_key')) {
                $query->where(function ($query) {
                $query->whereRaw('users.name LIKE "%'.Input::get('search_key').'%" OR users.email LIKE "%'.Input::get('search_key').'%" OR users.address LIKE "%'.Input::get('search_key').'%" OR users.phone LIKE "%'.Input::get('search_key').'%"' );
              });
        }
        if (Input::has('active') && (Input::get('active')!='')) {
            $query->where('active', Input::get('active'));
        }
        
        $datums = $query->orderBy('id', 'desc')->paginate(10);
       
        if($user_id){
            return view('admin.user.administratorindex', ['datums'=>$datums,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function create(Request $request)
    {
        $pageTitle = "Add Admin";
        $pageName = "Add Admin";
        $users = Auth::guard('web')->user();
        return view('admin.user.administratorcreate', ['pageName'=>$pageName,'pageTitle'=>$pageTitle]);
    }
    public function store(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $allData =$request->input();
       // echo "<pre>";print_r($allData);die;
        $user_data_email = DB::table('users')
            ->select('*')
            ->Where('users.deleted_at',NULL)
            ->where('users.email', '=', $allData['email'])
            ->first();
        if(isset($user_data_email)){
            return redirect()->back()->with('error', 'Email already registered.');
        }
        else {
            //$setting = DB::table('site_settings')->select('*')->where('id','=',1)->first();
           // $from_email = $setting->email;
            //$email_title = $setting->title;
            $data = new Register;
            $data->role = 'admin';
            $data->name = $allData['name'];
            $data->remember_token = $allData['_token'];
            $data->email = $allData['email'];
            $data->password = Hash::make($allData['password']);
            $data->phone = $allData['phone'];
            $data->gender = $allData['gender'];
            $data->type= 1;
            $data->active = $allData['active'];
            if($data->save()) {
                if($request->save=='Save')
                {
                    // $data = array('name' => $request->name,
                    //      'email' => $request->email,
                    //      'admin_email'=> $from_email, 
                    //      'logo' => $setting->logo,
                    //      'password'=> $request->password,
                    //      'title'=>$email_title,
                    //      'copyright'=>$setting->copyright
                    //    );
                    // $usermail = $request->email;
                    // Mail::send('admin.emails.email_verification', ['data'=> $data], function($message) use ($usermail,$from_email,$email_title) {
                    // $message->to($usermail, $email_title)
                    // ->subject('Admin Registration Email');
                    // $message->from($from_email,$email_title);
                    // });
                    return redirect()->route('signup.index')->with('success', 'Record successfully saved.');

                }else{
                    return redirect()->back()->with('success', 'Record successfully saved.');
                }
            } else {
                return redirect()->back()->with('error', 'Record not saved.');
            }
        }
    }
    public function edit($id)
    {
        $pageTitle ="Admin Edit";
        $pageName ="Admin Edit";
        $loginuser = Auth::guard('web')->user()->id;
        if($loginuser){
            $data = Register::find($id);
            return view('admin.user.administratoredit', ['data' => $data,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function update(Request $request, $id){
       $logo = $request->file('img');   
      if ($request->hasFile('img')) {
        $logo = $request->file('img');
        $img_name = time().'.'.$logo->getClientOriginalExtension();
        $destinationPath = public_path('/user_images/');
        $logo->move($destinationPath, $img_name); 
      }else{
        $img_name = '';
      }

    if ($request->hasFile('img')) {
        File::delete($request->hide_img);
      }

      $data= Register::find($id);
      $data->name = $request->name;
      $data->email = $request->email;
      $data->phone = $request->phone;
      $data->gender = $request->gender;
      if ($request->hasFile('img')) {
        $data->image = 'public/user_images/'.$img_name;
      }
      $data->save();
      return redirect()->back()->with('success', 'Record successfully updated.');
    }
    public function show($id)
    {
        $pageName = "Admin Show";
        $pageTitle ="Admin Show";
        $loginuser = Auth::guard('web')->user();
        if($loginuser){
            $data = Register::find($id);
            return view('admin.user.administratorshow', ['data' => $data,'pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function destroy($id)
    {
            $loginuser = Auth::guard('web')->user();
            if($loginuser){
            $data = register::find($id);
            if ($data->delete()) {
                if ($data->trashed()) {
                    return redirect()->route('signup.index')->with('success', 'Record successfully trashed.');
                }
            }
            }else{
               return Redirect::to('admin/login');
            }
    }
     public function update_status(Request $request){
      $all_data = Input::all();
        $res = DB::table('users')->where('id','=',$all_data['id'])->update(array('active'=>$all_data['data_value']));
        if($res){
          echo json_encode(array('success'=>true));
        }
        else{
          echo json_encode(array('success'=>false));
        }

    }
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => 'required',
                'email' => 'required | email | unique:users',
                'password' => 'required',
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

   

}