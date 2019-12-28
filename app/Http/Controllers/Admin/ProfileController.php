<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\User;
use DB;
use Input;
use Image;
use Auth;
use File;
use Hash;



class ProfileController extends Controller{  

    public function __construct(){
         $this->middleware(function ($request, $next) {
           $id = Auth::user()->id;
           if($id){
            if((Auth::user()->type==1)){
                return $next($request);
            }else{
                return redirect('admin/login/')->with('error', 'username or password incorrect.');
            }
           }else{
             return redirect('admin/login/');
           }
        });
        //$this->middleware('auth'); 
        //$this->middleware('admin');

    }

    public function index(){ 
      $id= Auth::guard('web')->user()->id;
     $data= User::find($id);
     $pageName = 'Profile';
     $pageTitle = 'Admin Profile';
     return view('admin.user.profile', ['data'=>$data,'pageName'=>$pageName,'pageTitle'=>$pageTitle]);

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

      $data= User::find($id);
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


      public function change_password(Request $request){
        $data = Auth::guard('web')->user();
        $pageName = 'Change Password';
        $pageTitle = 'Change Password';
        return view('admin.user.change_password',['data'=>$data,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
      }

       public function save_password(Request $request){
        $validator = $this->validator($request->all())->validate();
        
        $old_password =  $request->old_password;
        $id = Auth::guard('web')->user()->id;
         $chk_password = User::where('id',$id)->get();
        if(Hash::check($old_password,$chk_password[0]->password)){
           $data = User::find($id);
           $data->password = Hash::make($request->new_password);
           $data->save();
           return redirect()->back()->with('success', 'Successfully Updated Password');
        }else{
              return redirect()->back()->with('error', 'Old password incoorect');
        }

      }
      protected function validator(array $data)
      {
        return Validator::make(
        $data,
        [
        'old_password' => 'required',
        'new_password' => 'required',
        'confirm_password' => 'required | same:new_password'
        ],

        [
        'new_password.required' => 'Enter password.',
        'confirm_password.required' => 'Enter confirm password.',
        'confirm_password.same' => 'password does not match.'
        ]

        );

      }
















}