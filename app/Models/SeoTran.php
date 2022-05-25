<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;

class SeoTran extends Model {

    /**
     * Generated
     */
    public $timestamps  = false;
    protected $table    = 'seo_trans';
    protected $fillable = ['id', 'seo_id', 'locale', 'meta_title', 'meta_keyword', 'meta_description'];

}
