<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SiteSettings;
use DB;
use Input;
use Validator;
use Image;
use Auth;

class SiteSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware('admin');
    }
    public function index()
    {
        $pageTitle = 'Site Settings';
        $pageName = 'Site Settings';
        $data = DB::table('site_settings')->first();
        return view('admin.settings.index',['data'=> $data,'pageTitle'=>$pageTitle,'pageName'=>$pageName]); 

    }

 
   
    public function edit($id)
    {

    }
    
    public function update(Request $request, $id)
    { //echo "string"; die;
       //echo $request->address;die;
       $data = SiteSettings::find($id);
       $edit_image = $request->input('edit_image');
        $logo_image = $request->file('logo');
         if ($request->hasFile('logo')) {
            $logo_image = $request->file('logo');
            $original_name = $logo_image->getClientOriginalName();
            $extension = $logo_image->getClientOriginalExtension();
            $logoimagename = rand(11111, 99999) .time(). '.' . $extension; 
            $destinationPath = public_path('/uploads/logo');
            $logo_image->move($destinationPath, $logoimagename);
            $logo_name = '/uploads/logo/'.$logoimagename;
            if($edit_image!=''){
                unlink(public_path($edit_image));
            }
           
        }else{
            $logo_name = $edit_image;
        }
        $data->title = $request->title;
        $data->email = $request->email;
        $data->copyright = $request->copyright;
        $data->phone = $request->phone;
        $data->mobile = $request->mobile;
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->youtube_link = $request->youtube_link;
        $data->instagram = $request->instagram;
        $data->pinterest_link = $request->pinterest_link;
        $data->address = $request->address;
        $data->description = $request->description;
        $data->logo = $logo_name;
        $data->status = 1;
        if($data->save()) {
            return redirect()->back()->with('success', 'Record successfully updated.'); 
        } else {
            return redirect()->back()->with('error', 'Record not saved.');
        }
        
    }

    
    
   
    
   
   
     
}
