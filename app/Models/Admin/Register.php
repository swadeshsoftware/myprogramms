<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Register extends Model

{

    /**

     * The table associated with the model.

     *

     * @var string

     */

	use SoftDeletes;

    protected $table = 'users';

	protected $dates = ['deleted_at'];

	public function AdminType()
    {

        return $this->hasOne('App\Models\Admin\Register','id');

    }
}

