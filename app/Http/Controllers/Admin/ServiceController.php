<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Services;

use Illuminate\Support\Facades\Storage;

use DB;
use Input;
use Validator;
use Image;
use Hash;
use Auth;
use Mail;
use File;
use Crypt;
use Session;

class ServiceController extends Controller
{ 
    public function __construct()
    {
        
    }
    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $pageTitle = "Services";
        $pageName = "Services";
        $query = DB::table("services")->select('services.*')->where('services.deleted_at', NULL);
        if (Input::has('search_key')) {
                $query->where(function ($query) {
                $query->whereRaw('services.name LIKE "%'.Input::get('search_key').'%" OR services.title LIKE "%'.Input::get('search_key').'%" OR services.description LIKE "%'.Input::get('search_key').'%"' );
              });
        }
        if (Input::has('status') && (Input::get('status')!='')) {
            $query->where('services.status', Input::get('status'));
        }
       
        $datums = $query->orderBy('id', 'desc')->paginate(10);
       
        if($user_id){
            return view('admin.services.index', ['datums'=>$datums,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function create(Request $request)
    {
        $pageTitle = "Service Add";
        $pageName = "Service Add";
        $users = Auth::guard('web')->user();
        if($users){
            return view('admin.services.create', ['pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function store(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $allData =$request->input();
        $service_image = $request->file('image');
         if ($request->hasFile('image')) {
            $service_image = $request->file('image');
            $original_name = $service_image->getClientOriginalName();
            $extension = $service_image->getClientOriginalExtension();
            $serviceimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/services');
            $service_image->move($destinationPath, $serviceimagename);
            $service_name = '/uploads/services/'.$serviceimagename;
        }
            $data = new Services;
            $data->name = $allData['name'];
            $data->alias = $allData['alias'];
            $data->title = $allData['title'];
            $data->description = $allData['description'];
            $data->status = $allData['status'];
            $data->image = $service_name;
            $data->created_at = date('Y-m-d h:i:s');
            if($data->save()) {
                    return redirect()->route('services.index')->with('success', 'Record successfully saved.');
            } else {
                return redirect()->back()->with('error', 'Record not saved.');
            }
    }
    public function edit($id)
    {
        $pageTitle ="Service Edit";
        $pageName ="Service Edit";
        $loginuser = Auth::guard('web')->user()->id;
        if($loginuser){
          $data = Services::find($id);
            return view('admin.services.edit', ['data' => $data,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function update(Request $request, $id){
        //$validator = $this->validator($request->all())->validate();
        $data= Services::find($id);
        $edit_image = $request->input('edit_image');
        $service_image = $request->file('image');
        if ($request->hasFile('image')) {
            $service_image = $request->file('image');
            $original_name = $service_image->getClientOriginalName();
            $extension = $service_image->getClientOriginalExtension();
            $serviceimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/services');
            $service_image->move($destinationPath, $serviceimagename);
            $service_name = '/uploads/services/'.$serviceimagename;
            if($edit_image!=''){
                unlink(public_path($edit_image));
            }
        }else{
            $service_name = $edit_image;
        }
      $data->name = $request->name;
      $data->alias = $request->alias;
      $data->title = $request->title;
      $data->description = $request->description;
      $data->status = $request->status;
      $data->image = $service_name;
      $data->updated_at = date('Y-m-d h:i:s');
      $data->save();
      return redirect()->back()->with('success', 'Record successfully updated.');
    }
    public function show($id)
    {
        $pageName = "Service Show";
        $pageTitle ="Service Show";
        $loginuser = Auth::guard('web')->user();
        if($loginuser){
             $data = Services::find($id);
            return view('admin.services.show', ['data' => $data,'pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function destroy($id)
    {
            $loginuser = Auth::guard('web')->user();
            if($loginuser){
            $data = Services::find($id);
            if ($data->delete()) {
                if ($data->trashed()) {
                    return redirect()->route('services.index')->with('success', 'Record successfully trashed.');
                }
            }
            }else{
               return Redirect::to('admin/login');
            }
    }
     public function update_status(Request $request){
      $all_data = Input::all();
        $res = DB::table('services')->where('id','=',$all_data['id'])->update(array('status'=>$all_data['data_value']));
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
        'title' => 'required',
        'description' => 'required',
        'status' => 'required',
        'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required'
        ],

        [
        'name.required' => 'Please enter name.',
        'title.required' => 'Please enter title',
        'description.required' => 'Please enter description.',
        'status.required' => 'Please select status.',
        'image.required' => 'Please choose image.'
        ]

        );
    }

   

}