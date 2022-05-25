<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;
//use App\Traits\Seo;

class Pages extends Model {
	use \App\Traits\Seo;

	

    /**
     * Generated
     */
    public $timestamps  = false;
    protected $table    = 'pages';
    protected $fillable = ['id', 'name'];

}
