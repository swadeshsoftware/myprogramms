<?php
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Front\Blogs;
use DB;
use Input;
use Validator;
use Image;
use Auth;
use Request;
class BlogController extends Controller{
  public function __construct(){

  }

  public function index(){
    $pageTitle = 'Blogs';
    $pageName = 'Blogs';
    $blogs_obj = new Blogs();
    $datums = $blogs_obj->GetBlogs();
    //echo "<pre>";print_r($datums);die;
    echo "welcome";die;
       return view('front.blog.index',['pageTitle'=>$pageTitle,'$pageName'=>$pageName,'datums'=>$datums]);

  }
  public function BlogDetails(){
  	$pageTitle = 'Blog';
    $pageName = 'Blog';
    $blog_obj = new Blogs();
    $segment = Request::segment(2);
    $data = $blog_obj->GetBlog($segment);
    echo "welcome";die;
    return view('front.blog.blog-details',['pageTitle'=>$pageTitle,'$pageName'=>$pageName,'data'=>$data]);
  }
  
}