<?php
namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\ContactUs;
use DB;
use Input;
use Validator;
use Mail;
use Redirect;


class ContactUsController extends Controller{  
  public function ContactUs(){
    $pageTitle = 'Contact us';
    $pageName = 'Contact us';
    echo "welcome";die; 
    return view('front.page.contact',['pageTitle'=>$pageTitle,'pageName'=>$pageName]);
  }
  public function ContactSend(Request $request){
    $data = new ContactUs;  
    $data->name = $request->name;
    $data->email = $request->email;
    $data->phone = $request->phone;
    $data->message = $request->message;
    $site_setting = DB::table('site_settings')->select('*')->where('id','=',1)->first();
    $admin=array();
    if($data->save()) {
          $data = array(
              'name' => $request->post('name'),
              'email' => $request->post('email'),
              'phone' => $request->post('phone'),
              'message' => $request->post('message'),
              'site_title' => $site_setting->title,
              'site_logo' => $site_setting->logo,
              'site_email'=> $site_setting->email,
              'copyright'=> $site_setting->copyright
            );
            $admin = Db::table('users')->where('role', '=','admin')->where('deleted_at')->get()->all();
            if(isset($admin) && !empty($admin)){
                foreach ($admin as $key => $val) {
                $email[] = $val->email;
                }
            }
               $adminemail = $email;
                $from_mail = $site_setting->email;
                $title = $site_setting->title;
                $user_email = $request->post('email');
                Mail::send('front.email.contact', ['data'=> $data], function($message) use ($adminemail,$from_mail,$title) {
                     $message->to($adminemail, 'Contact Us')
                    ->subject('Contact Us');
                    $message->from($from_mail,$title);
                });
               
                if($request->post('email')!=''){
                     Mail::send('front.email.contact-us', ['data'=> $data], function($message) use ($user_email,$from_mail,$title) {
                     $message->to($user_email, 'Contact Us')
                    ->subject('Contact Us');
                    $message->from($from_mail,$title);
                });
            } 
             return redirect()->back()->with('success', 'Thank you for your enquiry.Your message has been sent successfully.');  
                }
            else {
                return redirect()->back()->with('error', 'Some problems .. try agian letter.');
            }
  }
 
}
