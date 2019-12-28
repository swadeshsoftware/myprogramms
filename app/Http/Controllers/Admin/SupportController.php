<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Supports;

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

class SupportController extends Controller
{ 
    public function __construct()
    {
        
    }
    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $pageTitle = "Supports";
        $pageName = "Supports";
        $query = DB::table("supports")->select('supports.*')->where('supports.deleted_at', NULL);
        if (Input::has('search_key')) {
                $query->where(function ($query) {
                $query->whereRaw('supports.title_heading LIKE "%'.Input::get('search_key').'%" OR supports.title LIKE "%'.Input::get('search_key').'%" OR supports.description LIKE "%'.Input::get('search_key').'%"' );
              });
        }
        if (Input::has('status') && (Input::get('status')!='')) {
            $query->where('supports.status', Input::get('status'));
        }
       
        $datums = $query->orderBy('id', 'desc')->paginate(10);
       
        if($user_id){
            return view('admin.supports.index', ['datums'=>$datums,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function create(Request $request)
    {
        $pageTitle = "Support Add";
        $pageName = "Support Add";
        $users = Auth::guard('web')->user();
        if($users){
            return view('admin.supports.create', ['pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function store(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $allData =$request->input();
        $support_image = $request->file('image');
         if ($request->hasFile('image')) {
            $support_image = $request->file('image');
            $original_name = $support_image->getClientOriginalName();
            $extension = $support_image->getClientOriginalExtension();
            $supportimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/supports');
            $support_image->move($destinationPath, $supportimagename);
            $support_name = '/uploads/supports/'.$supportimagename;
        }
            $data = new Supports;
            $data->title_heading = $allData['title_heading'];
            $data->title = $allData['title'];
            $data->description = $allData['description'];
            $data->status = $allData['status'];
            $data->image = $support_name;
            $data->created_at = date('Y-m-d h:i:s');
            if($data->save()) {
                    return redirect()->route('supports.index')->with('success', 'Record successfully saved.');
            } else {
                return redirect()->back()->with('error', 'Record not saved.');
            }
    }
    public function edit($id)
    {
        $pageTitle ="Support Edit";
        $pageName ="Support Edit";
        $loginuser = Auth::guard('web')->user()->id;
        if($loginuser){
          $data = Supports::find($id);
            return view('admin.supports.edit', ['data' => $data,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function update(Request $request, $id){
        //$validator = $this->validator($request->all())->validate();
        $data= Supports::find($id);
        $edit_image = $request->input('edit_image');
        $support_image = $request->file('image');
        if ($request->hasFile('image')) {
            $support_image = $request->file('image');
            $original_name = $support_image->getClientOriginalName();
            $extension = $support_image->getClientOriginalExtension();
            $supportimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/supports');
            $support_image->move($destinationPath, $supportimagename);
            $support_name = '/uploads/supports/'.$supportimagename;
            if($edit_image!=''){
                unlink(public_path($edit_image));
            }
        }else{
            $support_name = $edit_image;
        }
      $data->title_heading = $request->title_heading;
      $data->title = $request->title;
      $data->description = $request->description;
      $data->status = $request->status;
      $data->image = $support_name;
      $data->updated_at = date('Y-m-d h:i:s');
      $data->save();
      return redirect()->back()->with('success', 'Record successfully updated.');
    }
    public function show($id)
    {
        $pageName = "Support Show";
        $pageTitle ="Support Show";
        $loginuser = Auth::guard('web')->user();
        if($loginuser){
             $data = Supports::find($id);
            return view('admin.supports.show', ['data' => $data,'pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function destroy($id)
    {
            $loginuser = Auth::guard('web')->user();
            if($loginuser){
            $data = Supports::find($id);
            if ($data->delete()) {
                if ($data->trashed()) {
                    return redirect()->route('supports.index')->with('success', 'Record successfully trashed.');
                }
            }
            }else{
               return Redirect::to('admin/login');
            }
    }
     public function update_status(Request $request){
      $all_data = Input::all();
        $res = DB::table('supports')->where('id','=',$all_data['id'])->update(array('status'=>$all_data['data_value']));
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
        'title_heading' => 'required',
        'title' => 'required',
        'description' => 'required',
        'status' => 'required',
        'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required'
        ],

        [
        'title_heading.required' => 'Please enter heading.',
        'title.required' => 'Please enter title',
        'description.required' => 'Please enter description.',
        'status.required' => 'Please select status.',
        'image.required' => 'Please choose image.'
        ]

        );
    }

   

}