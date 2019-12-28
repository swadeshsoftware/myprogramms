<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\Home;
use DB;
use Input;
use Validator;
use Image;
use Auth;
class HomeController extends Controller{
  public function __construct(){

  }

  public function index(Request $request){
    $pageTitle = 'Home';
    $home_obj = new Home();
    $supports = $home_obj->GetSupportList();
    $whychooseus = $home_obj->GetWhyChooseUs();
    $ourservice = $home_obj->GetOurService();
    $services = $home_obj->GetServies();
    $testimonials = $home_obj->GetTestimonial();
    //echo "<pre>";print_r($testimonials);die;
       return view('front.home.index',['pageTitle'=>$pageTitle,'supports'=>$supports,'whychooseus'=>$whychooseus,'ourservice'=>$ourservice,'services'=>$services,'testimonials'=>$testimonials]);

  }
  public function CheckSubscribeEmail(Request $request){
  	$email = $request->sub_email;
  	$home_obj = new Home();
  	$checkemail = $home_obj->CheckSubscribeEmail($email);
  	if(isset($checkemail) && !empty($checkemail)){
  		echo 'false';
  	}else{
  		echo 'true';
  	}
  }
  public function Subscribes(Request $request){
  	$email = $request->sub_email;
  	$home_obj = new Home();
  	$data = array(
  			'email' => $email,
  			'created_at' => date('Y-m-d h:i:s')
  	);
  	$int_res = $home_obj->addSubcribes($data);
  	if($int_res){
  		$return = 1;
  	}else{
  		$return = 2;
  	}
  	return $return;
  }
  
}