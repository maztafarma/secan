<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;
use Illuminate\Support\Facades\App;

class Seo extends Model {

    /**
     * Generated
     */
    public $timestamps  = false;
    protected $table    = 'seo';
    protected $fillable = ['id', 'key_id', 'key_type'];

    public function key()
    {
        return $this->morphTo();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany('App\Models\SeoTran', 'seo_id', 'id');
    }

    /**
     * @return mixed
     */
    public function translation()
    {
        return $this->belongsTo('App\Models\SeoTran', 'id', 'seo_id')->where('locale', '=' , App::getLocale());
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
