<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Front\Services;
use DB;
use Input;
use Validator;
use Image;
use Auth;
use Request;
class ServicesController extends Controller{
  public function __construct(){

  }

  public function index(Request $request){
  	$segment =  Request::segment(2);
  	$pageName = ucwords(str_replace("-", " ", $segment));
  	$pageTitle = ucwords(str_replace("-", " ", $segment));
  	$service_obj = new Services();
  	$data = $service_obj->GetService($segment);
  	//echo "welcome";die;
    return view('front.service.index',['pageName'=>$pageName,'pageTitle'=>$pageTitle,'data'=>$data]);
  }
 
}