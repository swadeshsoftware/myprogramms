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

class Services extends Model
{
	public function GetService($alias=''){
		$query = DB::table('services')->select('*')->where('deleted_at',NULL)->where('status',1)->where('alias','=',$alias);
		return $data = $query->first();
	}
}
