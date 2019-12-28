<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pages;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use DB;
use Input;
use Image;
use Hash;
use Auth;
use Mail;
use File;
use Crypt;
use Session;

class PageController extends Controller
{ 
    public function __construct()
    {
        
    }
    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $pageTitle = "Pages";
        $pageName = "Pages";
        $query = DB::table("pages")->select('pages.*')->where('pages.deleted_at', NULL);
        if (Input::has('search_key')) {
                $query->where(function ($query) {
                $query->whereRaw('pages.name LIKE "%'.Input::get('search_key').'%" OR pages.alias LIKE "%'.Input::get('search_key').'%" OR pages.description LIKE "%'.Input::get('search_key').'%"' );
              });
        }
        if (Input::has('status') && (Input::get('status')!='')) {
            $query->where('pages.status', Input::get('status'));
        }
       
        $datums = $query->orderBy('id', 'desc')->paginate(10);
       
        if($user_id){
            return view('admin.pages.index', ['datums'=>$datums,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function create(Request $request)
    {
        $pageTitle = "Page Add";
        $pageName = "Page Add";
        $users = Auth::guard('web')->user();
        if($users){
            return view('admin.pages.create', ['pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function store(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $allData =$request->input();
            $data = new Pages;
            $data->name = $allData['name'];
            $data->alias = $allData['alias'];
            $data->description = $allData['description'];
            $data->meta_title = $allData['meta_title'];
            $data->meta_author = $allData['meta_author'];
            $data->meta_description = $allData['meta_description'];
            $data->status = $allData['status'];
            $data->created_at = date('Y-m-d h:i:s');
            if($data->save()) {
                    return redirect()->route('pages.index')->with('success', 'Record successfully saved.');
            } else {
                return redirect()->back()->with('error', 'Record not saved.');
            }
    }
    public function edit($id)
    {
        $pageTitle ="Page Edit";
        $pageName ="Page Edit";
        $loginuser = Auth::guard('web')->user()->id;
        if($loginuser){
          $data = Pages::find($id);
            return view('admin.pages.edit', ['data' => $data,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function update(Request $request, $id){
      $data= Pages::find($id);
      $data->name = $request->name;
      $data->description = $request->description;
      $data->meta_title = $request->meta_title;
      $data->meta_author = $request->meta_author;
      $data->meta_description = $request->meta_description;
      $data->status = $request->status;
      $data->updated_at = date('Y-m-d h:i:s');
      $data->save();
      return redirect()->back()->with('success', 'Record successfully updated.');
    }
    public function show($id)
    {
        $pageName = "Page Show";
        $pageTitle ="Page Show";
        $loginuser = Auth::guard('web')->user();
        if($loginuser){
             $data = Pages::find($id);
            return view('admin.pages.show', ['data' => $data,'pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function destroy($id)
    {
            $loginuser = Auth::guard('web')->user();
            if($loginuser){
            $data = Pages::find($id);
            if ($data->delete()) {
                if ($data->trashed()) {
                    return redirect()->route('pages.index')->with('success', 'Record successfully trashed.');
                }
            }
            }else{
               return Redirect::to('admin/login');
            }
    }
     public function update_status(Request $request){
      $all_data = Input::all();
        $res = DB::table('pages')->where('id','=',$all_data['id'])->update(array('status'=>$all_data['data_value']));
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
        'alias' => 'required',
        'description' => 'required',
        'status' => 'required'
        ],

        [
        'name.required' => 'Please enter name.',
        'alias.required' => 'Please enter designation',
        'description.required' => 'Please enter description.',
        'status.required' => 'Please select status.'
        ]

        );
    }

   

}