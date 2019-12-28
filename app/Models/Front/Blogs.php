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

class Blogs extends Model
{
	public function GetBlogs(){
		$query = DB::table('blogs')->select('*')->where('deleted_at',NULL)->where('status',1);
		return $data = $query->orderBy('id','DESC')->get();
	}
	public function GetBlog($alias=''){
		$query = DB::table('blogs')->select('*')->where('deleted_at',NULL)->where('status',1)->where('alias','=',$alias);
		return $data = $query->first();
	}
}
