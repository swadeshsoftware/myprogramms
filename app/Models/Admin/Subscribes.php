<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Subscribes extends Model

{

    /**

     * The table associated with the model.

     *

     * @var string

     */

	use SoftDeletes;

    protected $table = 'subscribes';
	protected $dates = ['deleted_at'];

	public function GetSubscribesdata($id=''){
		$query = DB::table('subscribes')->select('*')->where('id','=',$id)->where('deleted_at',NULL);
		return $data = $query->first();
	}
}

