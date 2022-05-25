<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;
use Illuminate\Support\Facades\App;

class TagRelated extends Model {

    /**
     * Generated
     */
    public $timestamps  = false;
    protected $table    = 'tag_related';
    protected $fillable = ['key_id', 'key_type', 'tag_id', 'created_at'];

    public function key()
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function tag()
    {
        return $this->belongsTo('App\Models\Tag', 'tag_id', 'id')->with(['translation', 'translations']); 
    }


    /***************** Scope *****************/

    /**
     * @param $id
     */
    public function scopeId($query, $params)
    {
        return $query->where('id', $params);
    }


}
