<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Banners;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use DB;
use Input;
use Image;
use Hash;
use Auth;
use Mail;
use File;
use Crypt;
use Session;

class BannerController extends Controller
{ 
    public function __construct()
    {
        
    }
    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $pageTitle = "Banners";
        $pageName = "Banners";
        $query = DB::table("banners")->select('banners.*')->where('banners.deleted_at', NULL);
        if (Input::has('search_key')) {
                $query->where(function ($query) {
                $query->whereRaw('banners.title LIKE "%'.Input::get('search_key').'%" OR banners.description LIKE "%'.Input::get('search_key').'%"' );
              });
        }
        if (Input::has('status') && (Input::get('status')!='')) {
            $query->where('banners.status', Input::get('status'));
        }
       
        $datums = $query->orderBy('id', 'desc')->paginate(10);
       
        if($user_id){
            return view('admin.banners.index', ['datums'=>$datums,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function create(Request $request)
    {
        $pageTitle = "Banner Add";
        $pageName = "Banner Add";
        $users = Auth::guard('web')->user();
        if($users){
            return view('admin.banners.create', ['pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function store(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $allData =$request->input();
        $banner_image = $request->file('image');
        if ($request->hasFile('image')) {
            $banner_image = $request->file('image');
            $original_name = $banner_image->getClientOriginalName();
            $extension = $banner_image->getClientOriginalExtension();
            $bannerimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/banners');
            $banner_image->move($destinationPath, $bannerimagename);
            $banner_name = '/uploads/banners/'.$bannerimagename;
        }
        if ($request->hasFile('service_image')) {
            $service_image = $request->file('service_image');
            $original_name = $service_image->getClientOriginalName();
            $extension = $service_image->getClientOriginalExtension();
            $serviceimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/banners');
            $service_image->move($destinationPath, $serviceimagename);
            $service_name = '/uploads/banners/'.$serviceimagename;
        }
            $data = new Banners;
            $data->title = $allData['title'];
            $data->description = $allData['description'];
            $data->status = $allData['status'];
            $data->image = $banner_name;
            $data->service_img = $service_name;
            $data->created_at = date('Y-m-d h:i:s');
            if($data->save()) {
                    return redirect()->route('banners.index')->with('success', 'Record successfully saved.');
            } else {
                return redirect()->back()->with('error', 'Record not saved.');
            }
    }
    public function edit($id)
    {

        $pageTitle ="Banner Edit";
        $pageName ="Banner Edit";
        $loginuser = Auth::guard('web')->user()->id;
        if($loginuser){
          $data = Banners::find($id);
            return view('admin.banners.edit', ['data' => $data,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function update(Request $request, $id){
      //$validator = $this->validator($request->all())->validate();
      $data= Banners::find($id);
        $edit_image = $request->input('edit_image');
        $banner_image = $request->file('image');
         if ($request->hasFile('image')) {
            $banner_image = $request->file('image');
            $original_name = $banner_image->getClientOriginalName();
            $extension = $banner_image->getClientOriginalExtension();
            $bannerimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/banners');
            $banner_image->move($destinationPath, $bannerimagename);
            $banner_name = '/uploads/banners/'.$bannerimagename;
            if($edit_image!=''){
                unlink(public_path($edit_image));
            }
           
        }else{
            $banner_name = $edit_image;
        }
        $service_edit_image = $request->input('service_edit_image');
        $service_image = $request->file('service_image');
         if ($request->hasFile('service_image')) {
            $service_image = $request->file('service_image');
            $original_name = $service_image->getClientOriginalName();
            $extension = $service_image->getClientOriginalExtension();
            $serviceimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/banners');
            $service_image->move($destinationPath, $serviceimagename);
            $service_name = '/uploads/banners/'.$serviceimagename;
            if($service_edit_image!=''){
                unlink(public_path($service_edit_image));
            }
           
        }else{
            $service_name = $service_edit_image;
        }
      $data->title = $request->title;
      $data->description = $request->description;
      $data->status = $request->status;
      $data->image = $banner_name;
      $data->service_img = $service_name;
      $data->updated_at = date('Y-m-d h:i:s');
      $data->save();
      return redirect()->back()->with('success', 'Record successfully updated.');
    }
    public function show($id)
    {
        $pageName = "Banner Show";
        $pageTitle ="Banner Show";
        $loginuser = Auth::guard('web')->user();
        if($loginuser){
             $data = Banners::find($id);
            return view('admin.banners.show', ['data' => $data,'pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function destroy($id)
    {
            $loginuser = Auth::guard('web')->user();
            if($loginuser){
            $data = Banners::find($id);
            if ($data->delete()) {
                if ($data->trashed()) {
                    return redirect()->route('banners.index')->with('success', 'Record successfully trashed.');
                }
            }
            }else{
               return Redirect::to('admin/login');
            }
    }
     public function update_status(Request $request){
      $all_data = Input::all();
        $res = DB::table('banners')->where('id','=',$all_data['id'])->update(array('status'=>$all_data['data_value']));
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
        'title' => 'required',
        'description' => 'required',
        'status' => 'required',
        'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required',
        'service_image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required'
        ],

        [
        'title.required' => 'Please enter banner title.',
        'description.required' => 'Please enter banner description.',
        'status.required' => 'Please select status.',
        'image.required' => 'Please choose image.',
        'service_image.required' => 'Please choose service image.'
        ]

        );
    }

   

}