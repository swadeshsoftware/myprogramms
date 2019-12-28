<?php
	namespace App\Models\Front;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\SoftDeletes;
	use DB;
	use Input;
	use Validator;
	use Image;
	use Auth;
	use Hash;
	use File;
	use Request;
	class BaseModel extends Model{
		public function GetSiteSettingList(){
			return $data = DB::table('site_settings')->where('deleted_at',NULL)->where('status','=',1)->first();
		}
		public function GetBannerList(){
			return $data = DB::table('banners')->where('deleted_at',NULL)->where('status',1)->get();
		}
		public function GetServiceList(){
			$query = DB::table('services')->select('name','alias')->where('status',1)->where('deleted_at',NULL);
			return $data = $query->orderBy('id','DESC')->get();
		}
		
		
		
	}