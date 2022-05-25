<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;

class TagTran extends Model {

    /**
     * Generated
     */
    public $timestamps  = false;
    protected $table    = 'tag_trans';
    protected $fillable = ['id', 'tag_id', 'locale', 'title', 'created_at'];

}
