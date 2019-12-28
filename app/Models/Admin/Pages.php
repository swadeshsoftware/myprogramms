<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pages extends Model

{

    /**

     * The table associated with the model.

     *

     * @var string

     */

	use SoftDeletes;

    protected $table = 'pages';
	protected $dates = ['deleted_at'];
}

