<?php

namespace App\Models;
use App\Models\BaseModel as Model;
use App\Traits\Seo;
use App\Observers\SeoActionsObserver;

class Video extends Model
{
    use Seo;
	
	protected $table = 'video';
	protected $fillable = [
		'thumbnail',
		'youtube_url',
		'category_id',
		'doctor_id',
		'publish_date',
		'created_at',
		'updated_at',
	];
    public $timestamps = false;


	public function translations()
	{
		return $this->hasMany(\App\Models\VideoTran::class,'video_id','id');
	}

    /**
     * @return mixed
     */
    public function translation()
    {
    	
    	return $this->belongsTo(\App\Models\VideoTran::class,'id','video_id')
            ->where('locale', '=' , $this->getCurrentLocalize());
    }

    /**
     * @return mixed
     */
    public function doctor()
    {
    	
    	return $this->belongsTo(\App\Models\Doctor::class,'doctor_id','id');
    }

    /**
     * @return mixed
     */
    public function category()
    {
    	
    	return $this->belongsTo(\App\Models\Category::class,'category_id','id');
    }

    public function tags()
    {
        return $this->morphMany(\App\Models\TagRelated::class, 'key')->with('tag');   
    }

    public static function boot() {
        parent::boot();
        Video::observe(new SeoActionsObserver());
    }
}