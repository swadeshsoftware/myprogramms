<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\Common;
use DB;
use Input;
use Validator;
use Image;
use Auth;
class CommonController extends Controller{
  public function __construct(){

  }

  public function AboutUs(){
    $pageTitle = 'About Us';
    $pageName = 'About Us';
    $about_obj = new Common();
    $data = $about_obj->GetAboutUs();
    //echo "welcome";die;
       return view('front.page.about-us',['pageTitle'=>$pageTitle,'$pageName'=>$pageName,'data'=>$data]);

  }
  public function TermsAndCondition(){
  	$pageTitle = 'Terms and Condition';
    $pageName = 'Terms and Condition';
    $terms_obj = new Common();
    $data = $terms_obj->GetTermsAndCondition();
    echo "welcome";die;
    return view('front.page.terms-and-condition',['pageTitle'=>$pageTitle,'$pageName'=>$pageName,'data'=>$data]);
  }
  public function FAQ(){
  	$pageTitle = 'FAQ';
    $pageName = 'FAQ';
    $faq_obj = new Common();
    $data = $faq_obj->GetFaq();
    echo "welcome";die;
    return view('front.page.faq',['pageTitle'=>$pageTitle,'$pageName'=>$pageName,'data'=>$data]);
  }
  public function PrivacyPolicy(){
    $pageTitle = 'Privacy Policy';
    $pageName = 'Privacy Policy';
    $policy_obj = new Common();
    $data = $policy_obj->GetPrivacyPolicy();
    //echo "<pre>";print_r($data);die;
    echo "welcome";die;
    return view('front.page.privacy-policy',['pageTitle'=>$pageTitle,'$pageName'=>$pageName,'data'=>$data]);
  }
}