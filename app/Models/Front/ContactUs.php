<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
	use SoftDeletes;
    protected $table = 'contact_us';
	protected $dates = ['deleted_at'];
}
