<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;
use Illuminate\Support\Facades\App;

class Tag extends Model {

    /**
     * Generated
     */
    public $timestamps  = false;
    protected $table    = 'tag';
    protected $fillable = ['id', 'slug', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany('App\Models\TagTran', 'tag_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function type()
    {
        return $this->hasMany('App\Models\TagRelated', 'tag_id', 'id');
    }

    /**
     * @return mixed
     */
    public function translation()
    {
        return $this->belongsTo('App\Models\TagTran', 'id', 'tag_id')->where('locale', '=' , App::getLocale());
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
