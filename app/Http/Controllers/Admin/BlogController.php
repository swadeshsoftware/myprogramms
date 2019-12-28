<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Blogs;

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

class BlogController extends Controller
{ 
    public function __construct()
    {
        
    }
    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $pageTitle = "Blogs";
        $pageName = "Blogs";
        $query = DB::table("blogs")->select('blogs.*')->where('blogs.deleted_at', NULL);
        if (Input::has('search_key')) {
                $query->where(function ($query) {
                $query->whereRaw('blogs.title LIKE "%'.Input::get('search_key').'%" OR blogs.description LIKE "%'.Input::get('search_key').'%"' );
              });
        }
        if (Input::has('status') && (Input::get('status')!='')) {
            $query->where('blogs.status', Input::get('status'));
        }
       
        $datums = $query->orderBy('id', 'desc')->paginate(10);
       
        if($user_id){
            return view('admin.blog.index', ['datums'=>$datums,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function create(Request $request)
    {
        $pageTitle = "Blog Add";
        $pageName = "Blog Add";
        $users = Auth::guard('web')->user();
        if($users){
            return view('admin.blog.create', ['pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function store(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $allData =$request->input();
        $blog_image = $request->file('image');
         if ($request->hasFile('image')) {
            $blog_image = $request->file('image');
            $original_name = $blog_image->getClientOriginalName();
            $extension = $blog_image->getClientOriginalExtension();
            $blogimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/blogs');
            $blog_image->move($destinationPath, $blogimagename);
            $blog_name = '/uploads/blogs/'.$blogimagename;
        }
            $data = new Blogs;
            $data->title = $allData['title'];
            $data->alias = $allData['alias'];
            $data->description = $allData['description'];
            $data->meta_title = $allData['meta_title'];
            $data->meta_author = $allData['meta_author'];
            $data->meta_description = $allData['meta_description'];
            $data->status = $allData['status'];
            $data->image = $blog_name;
            $data->created_at = date('Y-m-d h:i:s');
            if($data->save()) {
                    return redirect()->route('blogs.index')->with('success', 'Record successfully saved.');
            } else {
                return redirect()->back()->with('error', 'Record not saved.');
            }
    }
    public function edit($id)
    {
        $pageTitle ="Blog Edit";
        $pageName ="Blog Edit";
        $loginuser = Auth::guard('web')->user()->id;
        if($loginuser){
          $data = Blogs::find($id);
            return view('admin.blog.edit', ['data' => $data,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function update(Request $request, $id){
        //$validator = $this->validator($request->all())->validate();
        $data= Blogs::find($id);
        $edit_image = $request->input('edit_image');
        $blog_image = $request->file('image');
        if ($request->hasFile('image')) {
            $blog_image = $request->file('image');
            $original_name = $blog_image->getClientOriginalName();
            $extension = $blog_image->getClientOriginalExtension();
            $blogimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/blogs');
            $blog_image->move($destinationPath, $blogimagename);
            $blog_name = '/uploads/blogs/'.$blogimagename;
            if($edit_image!=''){
                unlink(public_path($edit_image));
            }
        }else{
            $blog_name = $edit_image;
        }
      $data->title = $request->title;
      $data->alias = $request->alias;
      $data->description = $request->description;
      $data->meta_title = $request->meta_title;
      $data->meta_author = $request->meta_author;
      $data->meta_description = $request->meta_description;
      $data->status = $request->status;
      $data->image = $blog_name;
      $data->updated_at = date('Y-m-d h:i:s');
      $data->save();
      return redirect()->back()->with('success', 'Record successfully updated.');
    }
    public function show($id)
    {
        $pageName = "Blog Show";
        $pageTitle ="Blog Show";
        $loginuser = Auth::guard('web')->user();
        if($loginuser){
             $data = Blogs::find($id);
             //echo "<pre>";print_r($data);die;
            return view('admin.blog.show', ['data' => $data,'pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function destroy($id)
    {
            $loginuser = Auth::guard('web')->user();
            if($loginuser){
            $data = Blogs::find($id);
            if ($data->delete()) {
                if ($data->trashed()) {
                    return redirect()->route('blogs.index')->with('success', 'Record successfully trashed.');
                }
            }
            }else{
               return Redirect::to('admin/login');
            }
    }
    public function multiple_destroy()
    {
        $multiple_ids = Input::get('multiple_ids');
        if(count($multiple_ids) > 0) { 
            $multiple_ids = explode(',',$multiple_ids);
            foreach($multiple_ids as $id){
                $this->destroy($id);
            }
            return redirect()->back()->with('success', 'Record successfully trashed.');
        } else {
            return redirect()->back()->with('error', 'Please first make a selection from the list.');
        }
    }
     public function update_status(Request $request){
      $all_data = Input::all();
        $res = DB::table('blogs')->where('id','=',$all_data['id'])->update(array('status'=>$all_data['data_value']));
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
        'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required'
        ],

        [
        'title.required' => 'Please enter title',
        'description.required' => 'Please enter description.',
        'status.required' => 'Please select status.',
        'image.required' => 'Please choose image.'
        ]

        );
    }

   

}