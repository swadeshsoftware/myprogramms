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

class Testimonials extends Model
{
	public function GetTestimonials(){
		$query = DB::table('testimonials')->select('*')->where('deleted_at',NULL)->where('status',1);
		return $data = $query->orderBy('id','DESC')->get();
	}
}
