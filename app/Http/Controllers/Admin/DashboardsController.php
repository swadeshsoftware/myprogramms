<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DashboardsController extends Controller
{
     public function __construct()
    {
        //dd('hhhhhh');
        // $this->middleware('auth'); 
        // $this->middleware('admin');
    }
    public function index()
    {
        
        $user = Auth::user();
        if($user){
            return view('admin.dashboard.index', ['pageTitle'=>'Dashboards']);
        }else{
            return view('admin.access.index');
        }
    }

}
