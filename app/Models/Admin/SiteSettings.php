<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteSettings extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
	use SoftDeletes;
    protected $table = 'site_settings';
	protected $dates = ['deleted_at'];
	
	
}
