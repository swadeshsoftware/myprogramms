<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Front\Testimonials;
use DB;
use Input;
use Validator;
use Image;
use Auth;
use Request;
class TestimonialsController extends Controller{
  public function __construct(){

  }

  public function index(Request $request){
    $pageName = "Testimonial";
    $pageTitle = "Testimonial";
    $testimonial_obj = new Testimonials();
    $datums = $testimonial_obj->GetTestimonials();
    echo "welcome";die;
    return view('front.testimonial.index',['pageTitle'=>$pageTitle,'pageName'=>$pageName]);
  }
 
}