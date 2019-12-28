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

class Whychooseus extends Model
{
	public function GetWhyChooseUs($alias=''){
		$query = DB::table('why_choose_us')->select('*')->where('status',1)->where('deleted_at',NULL)->where('alias','=',$alias);
		return $data = $query->first();
	}
}
