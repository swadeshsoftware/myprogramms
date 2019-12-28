<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Whychooseus extends Model

{

    /**

     * The table associated with the model.

     *

     * @var string

     */

	use SoftDeletes;

    protected $table = 'why_choose_us';
	protected $dates = ['deleted_at'];
}

