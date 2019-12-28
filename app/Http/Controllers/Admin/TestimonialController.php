<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Testimonals;

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

class TestimonialController extends Controller
{ 
    public function __construct()
    {
        
    }
    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $pageTitle = "Testimonals";
        $pageName = "Testimonals";
        $query = DB::table("testimonials")->select('testimonials.*')->where('testimonials.deleted_at', NULL);
        if (Input::has('search_key')) {
                $query->where(function ($query) {
                $query->whereRaw('testimonials.name LIKE "%'.Input::get('search_key').'%" OR testimonials.designation LIKE "%'.Input::get('search_key').'%" OR testimonials.description LIKE "%'.Input::get('search_key').'%"' );
              });
        }
        if (Input::has('status') && (Input::get('status')!='')) {
            $query->where('testimonials.status', Input::get('status'));
        }
       
        $datums = $query->orderBy('id', 'desc')->paginate(10);
       
        if($user_id){
            return view('admin.testimonials.index', ['datums'=>$datums,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function create(Request $request)
    {
        $pageTitle = "Testimonal Add";
        $pageName = "Testimonal Add";
        $users = Auth::guard('web')->user();
        if($users){
            return view('admin.testimonials.create', ['pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function store(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $allData =$request->input();
        $testimonial_image = $request->file('image');
         if ($request->hasFile('image')) {
            $testimonial_image = $request->file('image');
            $original_name = $testimonial_image->getClientOriginalName();
            $extension = $testimonial_image->getClientOriginalExtension();
            $testimonialimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/testimonials');
            $testimonial_image->move($destinationPath, $testimonialimagename);
            $testimonial_name = '/uploads/testimonials/'.$testimonialimagename;
        }
            $data = new Testimonals;
            $data->name = $allData['name'];
             $data->designation = $allData['designation'];
            $data->description = $allData['description'];
            $data->status = $allData['status'];
            $data->image = $testimonial_name;
            $data->created_at = date('Y-m-d h:i:s');
            if($data->save()) {
                    return redirect()->route('testimonals.index')->with('success', 'Record successfully saved.');
            } else {
                return redirect()->back()->with('error', 'Record not saved.');
            }
    }
    public function edit($id)
    {
        $pageTitle ="Testimonal Edit";
        $pageName ="Testimonal Edit";
        $loginuser = Auth::guard('web')->user()->id;
        if($loginuser){
          $data = Testimonals::find($id);
            return view('admin.testimonials.edit', ['data' => $data,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
       
    }
    public function update(Request $request, $id){
        //$validator = $this->validator($request->all())->validate();
        $data= Testimonals::find($id);
        $edit_image = $request->input('edit_image');
        $testimonial_image = $request->file('image');
        if ($request->hasFile('image')) {
            $testimonial_image = $request->file('image');
            $original_name = $testimonial_image->getClientOriginalName();
            $extension = $testimonial_image->getClientOriginalExtension();
            $testimonialimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/testimonials');
            $testimonial_image->move($destinationPath, $testimonialimagename);
            $testimonial_name = '/uploads/testimonials/'.$testimonialimagename;
            if($edit_image!=''){
                unlink(public_path($edit_image));
            }
        }else{
            $testimonial_name = $edit_image;
        }
      $data->name = $request->name;
       $data->designation = $request->designation;
      $data->description = $request->description;
      $data->status = $request->status;
       $data->image = $testimonial_name;
      $data->updated_at = date('Y-m-d h:i:s');
      $data->save();
      return redirect()->back()->with('success', 'Record successfully updated.');
    }
    public function show($id)
    {
        $pageName = "Testimonal Show";
        $pageTitle ="Testimonal Show";
        $loginuser = Auth::guard('web')->user();
        if($loginuser){
             $data = Testimonals::find($id);
            return view('admin.testimonials.show', ['data' => $data,'pageName'=>$pageName,'pageTitle'=>$pageTitle]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function destroy($id)
    {
            $loginuser = Auth::guard('web')->user();
            if($loginuser){
            $data = Testimonals::find($id);
            if ($data->delete()) {
                if ($data->trashed()) {
                    return redirect()->route('testimonals.index')->with('success', 'Record successfully trashed.');
                }
            }
            }else{
               return Redirect::to('admin/login');
            }
    }
     public function update_status(Request $request){
      $all_data = Input::all();
        $res = DB::table('testimonials')->where('id','=',$all_data['id'])->update(array('status'=>$all_data['data_value']));
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
        'designation' => 'required',
        'description' => 'required',
        'status' => 'required',
        'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required'
        ],

        [
        'name.required' => 'Please enter name.',
        'designation.required' => 'Please enter designation',
        'description.required' => 'Please enter description.',
        'status.required' => 'Please select status.',
        'image.required' => 'Please choose image.'
        ]

        );
    }

   

}