<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use DB;
use Input;
use Image;
use Auth;
use Mail;

class Home extends Model
{
	public function GetSupportList(){
		$query = DB::table('supports')->where('deleted_at',NULL)->where('status','=',1);
		return $data = $query->orderBy('id','DESC')->get();
	}
	public function GetWhyChooseUs(){
		$query = DB::table('why_choose_us')->select('*')->where('deleted_at',NULL)->where('status',1);
		return $data = $query->first();
	}
	public function GetOurService(){
		$query = DB::table('pages')->select('*')->where('deleted_at',NULL)->where('status',1)->where('alias','=','our-services');
		return $data = $query->first();
	}
	public function GetServies(){
		$query = DB::table('services')->select('*')->where('deleted_at',NULL)->where('status',1);
		return $data = $query->orderBy('id','DESC')->get();
	}
	public function GetTestimonial(){
		$query = DB::table('testimonials')->select('*')->where('deleted_at',NULL)->where('status',1);
		return $data = $query->orderBy('id','DESC')->get();
	}
	public function CheckSubscribeEmail($email=''){
		$query = DB::table('subscribes')->select('*')->where('email','=',$email);
		return $data = $query->first();
	}
	public function addSubcribes($data=''){
		return $res=DB::table('subscribes')->insert($data);
	}
	
}
