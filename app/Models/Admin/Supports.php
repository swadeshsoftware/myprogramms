<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Supports extends Model

{

    /**

     * The table associated with the model.

     *

     * @var string

     */

	use SoftDeletes;

    protected $table = 'supports';
	protected $dates = ['deleted_at'];
}

