<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Front\Whychooseus;
use DB;
use Input;
use Validator;
use Image;
use Auth;
use Request;
class WhyChooseUsController extends Controller{
  public function __construct(){

  }

  public function index(Request $request){
    $segment = Request::segment(2);
    $pageName ="Why Choose Us";
    $pageTitle = "Why Choose Us";
    $whychoose_obj = new Whychooseus();
    $data = $whychoose_obj->GetWhyChooseUs($segment);
    echo "welcome";die;
    return view('front.why-choose-us.index',['pageName'=>$pageName,'pageTitle'=>$pageTitle,'data'=>$data]);
  }
 
}