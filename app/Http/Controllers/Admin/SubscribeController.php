<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Subscribes;
use App\Models\Front\BaseModel;

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

class SubscribeController extends Controller
{ 
    public function __construct()
    {
        
    }
    public function index()
    {
       // echo "string";die;
        $user_id = Auth::guard('web')->user()->id;
        $pageTitle = "Subcribes";
        $pageName = "Subcribes";
        $query = DB::table("subscribes")->select('subscribes.*')->where('subscribes.deleted_at', NULL);
        if (Input::has('search_key')) {
                $query->where(function ($query) {
                $query->whereRaw('subscribes.email LIKE "%'.Input::get('search_key').'%"' );
              });
        }
        $datums = $query->orderBy('id', 'desc')->paginate(10);
        
        if($user_id){
            return view('admin.subscribe.index', ['datums'=>$datums,'pageTitle'=>$pageTitle,'pageName'=>$pageName]);
        }else{
            return Redirect::to('admin/login');
        }
    }
    public function destroy($id)
    {
            $loginuser = Auth::guard('web')->user();
            if($loginuser){
            $data = Subscribes::find($id);
            if ($data->delete()) {
                if ($data->trashed()) {
                    return redirect()->route('subscribes.index')->with('success', 'Record successfully trashed.');
                }
            }
            }else{
               return Redirect::to('admin/login');
            }
    }
    public function SendSubscribeMailModal(){
        $id = Input::get('id');
        $subscribe_obj = new Subscribes();
        $data = $subscribe_obj->GetSubscribesdata($id);
        return view('admin.ajax.subscribe-send-mail-modal',['data'=>$data]);
    }
    public function SendMail(Request $request){
        $validator = $this->validator($request->all())->validate();
        $alldata = $request->all();
        $subscribe_obj = new Subscribes();
        $setting_obj = new BaseModel();
        $sub_data = $subscribe_obj->GetSubscribesdata($alldata['id']);
        $setting = $setting_obj->GetSiteSettingList();
        $data = array(
              'email' => $sub_data->email,
              'subject' => $alldata['subject'],
              'message' => $alldata['message'],
              'site_title' => $setting->title,
              'logo' => $setting->logo,
              'site_email'=> $setting->email,
              'copyright'=> $setting->copyright
            );
        $to_mail = $sub_data->email;
        $from_mail = $setting->email;
        $title = $setting->title;
        $sub = $alldata['subject'];
        $mail = Mail::send('admin.emails.subscribe', ['data'=> $data], function($message) use ($to_mail,$from_mail,$title,$sub) {
                     $message->to($to_mail, $sub)
                    ->subject($sub);
                    $message->from($from_mail,$title);
                });
        if($mail){
            $return = 1;
        }else{
            $return = 2;
        }
        return $return;
    }
    public function multiple_destroy(){
        $multiple_ids = Input::get('multiple_ids');
        //echo "<pre>";print_r($multiple_ids);die;
        if($multiple_ids) { 
            $multiple_ids = explode(',',$multiple_ids);
            foreach($multiple_ids as $id){
                $this->destroy($id);
            }
            return redirect()->back()->with('success', 'Record successfully trashed.');
        } else {
            return redirect()->back()->with('error', 'Please first make a selection from the list.');
        }
    }
    public function SendBulkMailModal(){

        $multiple_ids = Input::get('multiple_ids');
        $multi_ids = explode(',',$multiple_ids);
        return view('admin.ajax.subscribe-bulk-mail-modal',['multiple_ids'=>$multiple_ids]);
    }
     public function BulkSendMail(Request $request)
    {
        $validator = $this->validator($request->all())->validate();
        $alldata = Input::all();
        $multiple_ids = $alldata['id'];
        $setting_obj = new BaseModel();
        $setting = $setting_obj->GetSiteSettingList();
            
            $multi_ids = explode(',',$multiple_ids);
            $subscribes = DB::table('subscribes')->whereIn('id', $multi_ids)->get();
            $email_array = array();
            foreach ($subscribes as $key => $value) {
               $email_array[$key]= $value->email;
            }
            $data = array(
              'subject' => $alldata['subject'],
              'message' => $alldata['message'],
              'site_title' => $setting->title,
              'logo' => $setting->logo,
              'site_email'=> $setting->email,
              'copyright'=> $setting->copyright
            );
            $to_mail = $email_array;
            $from_mail = $setting->email;
            $title = $setting->title;
            $sub = $alldata['subject'];
            $mail = Mail::send('admin.emails.bulksubscribe', ['data'=> $data], function($message) use ($to_mail,$from_mail,$title,$sub) {
                     $message->to($to_mail, $sub)
                    ->subject($sub);
                    $message->from($from_mail,$title);
                });
            if($mail){
                $return = 1;
            }else{
                $return = 2;
            }
            return $return;
    }
    protected function validator(array $data)
    {
        return Validator::make(
        $data,
        [
        'subject' => 'required',
        'message' => 'required|max:200|min:20'
        ],

        [
        'subject.required' => 'Please enter subject.',
        'message.required' => 'Please enter message.',
        'message.max' => 'Maximum 200 characthers are allowed.',
        'message.min' => 'Minimum 20 characthers are allowed.'
        ]

        );
    }
}