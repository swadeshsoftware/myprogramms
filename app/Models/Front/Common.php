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

class Common extends Model
{
	public function GetAboutUs(){
		$query = DB::table('pages')->select('*')->where('status',1)->where('deleted_at',NULL)->where('alias','=','about-us');
		return $data = $query->first();
	}
	public function GetTermsAndCondition(){
		$query = DB::table('pages')->select('*')->where('status',1)->where('deleted_at',NULL)->where('alias','=','terms-and-condition');
		return $data = $query->first();
	}
	public function GetFaq(){
		$query = DB::table('pages')->select('*')->where('status',1)->where('deleted_at',NULL)->where('alias','=','faq');
		return $data = $query->first();
	}
	public function GetPrivacyPolicy(){
		$query = DB::table('pages')->select('*')->where('status',1)->where('deleted_at',NULL)->where('alias','=','privacy-policy');
		return $data = $query->first();
	}
}
