<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Front\BaseModel;
use DB;
use Auth;
use Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        //dd('dibakar');
    }
	public static function GetSiteSettingList(){
		$base_model_obj = new BaseModel();
		return $setting = $base_model_obj->GetSiteSettingList();
	}
	public static function GetBannerList(){
		$base_model_obj = new BaseModel();
		return $setting = $base_model_obj->GetBannerList();
	}
	public static function GetServicesList(){
		$base_model_obj = new BaseModel();
		return $services = $base_model_obj->GetServiceList();
	}
}
