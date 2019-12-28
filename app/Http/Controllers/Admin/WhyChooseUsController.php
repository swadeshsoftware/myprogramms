<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Whychooseus;

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

class WhyChooseUsController extends Controller
{ 
    public function __construct()
    {
        
    }
    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $pageTitle = "Why Choose Us";
        $pageName = "Why Choose Us";
        $query = DB::table("why_choose_us")->select('why_choose_us.*')->where('why_choose_us.deleted_at', NULL);
        if (Input::has('search_key')) {
                $query->where(function ($query) {
                $query->whereRaw('why_choose_us.name LIKE "%'.Input::get('search_key').'%" OR why_choose_us.short_description LIKE "%'.Input::get('search_key').'%" OR why_choose_us.description LIKE "%'.Input::get('search_key').'%"' );
              });
        }
        if (Input::has('status') && (Input::get('status')!='')) {
            $query->where('why_choose_us.status', Input::get('status'));
        }
       
        $datums = $query->orderBy('id', 'desc')->paginate(10);
       
        if($user_id){
            return view('admin.why-choose-us.index', ['datums'=>$datums,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function create(Request $request)
    {
        $pageTitle = "Why Choose Us Add";
        $pageName = "Why Choose Us Add";
        $users = Auth::guard('web')->user();
        if($users){
            return view('admin.why-choose-us.create', ['pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function store(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $allData =$request->input();
        $why_choose_image = $request->file('image');
         if ($request->hasFile('image')) {
            $why_choose_image = $request->file('image');
            $original_name = $why_choose_image->getClientOriginalName();
            $extension = $why_choose_image->getClientOriginalExtension();
            $whychooseimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/why_choose_image');
            $why_choose_image->move($destinationPath, $whychooseimagename);
            $why_choose_name = '/uploads/why_choose_image/'.$whychooseimagename;
        }
            $data = new Whychooseus;
            $data->name = $allData['name'];
            $data->alias = $allData['alias'];
            $data->short_description = $allData['short_description'];
            $data->description = $allData['description'];
            $data->status = $allData['status'];
            $data->image = $why_choose_name;
            $data->created_at = date('Y-m-d h:i:s');
            if($data->save()) {
                    return redirect()->route('why-choose-us.index')->with('success', 'Record successfully saved.');
            } else {
                return redirect()->back()->with('error', 'Record not saved.');
            }
    }
    public function edit($id)
    {
        $pageTitle ="Why Choose Us Edit";
        $pageName ="Why Choose Us Edit";
        $loginuser = Auth::guard('web')->user()->id;
        if($loginuser){
          $data = Whychooseus::find($id);
            return view('admin.why-choose-us.edit', ['data' => $data,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function update(Request $request, $id){
        //echo "string";die;
        //$validator = $this->validator($request->all())->validate();
        $data= Whychooseus::find($id);
        $edit_image = $request->input('edit_image');
        $why_choose_image = $request->file('image');
        if ($request->hasFile('image')) {
            $why_choose_image = $request->file('image');
            $original_name = $why_choose_image->getClientOriginalName();
            $extension = $why_choose_image->getClientOriginalExtension();
            $whychooseimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/why_choose_image');
            $why_choose_image->move($destinationPath, $whychooseimagename);
            $why_choose_name = '/uploads/why_choose_image/'.$whychooseimagename;
            if($edit_image!=''){
                unlink(public_path($edit_image));
            }
        }else{
            $why_choose_name = $edit_image;
        }
      $data->name = $request->name;
      $data->alias = $request->alias;
      $data->short_description = $request->short_description;
      $data->description = $request->description;
      $data->status = $request->status;
      $data->image = $why_choose_name;
      $data->updated_at = date('Y-m-d h:i:s');
      $data->save();
      return redirect()->back()->with('success', 'Record successfully updated.');
    }
    public function show($id)
    {
        $pageName = "Why Choose Us Show";
        $pageTitle ="Why Choose Us Show";
        $loginuser = Auth::guard('web')->user();
        if($loginuser){
             $data = Whychooseus::find($id);
            return view('admin.why-choose-us.show', ['data' => $data,'pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    protected function validator(array $data)
    {
        return Validator::make(
        $data,
        [
        'name' => 'required',
        'short_description' => 'required',
        'description' => 'required',
        'status' => 'required',
        'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required'
        ],

        [
        'name.required' => 'Please enter name.',
        'short_description.required' => 'Please enter short description',
        'description.required' => 'Please enter description.',
        'status.required' => 'Please select status.',
        'image.required' => 'Please choose image.'
        ]

        );
    }

   

}