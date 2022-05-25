<?php

namespace App\Models;
use App\Traits\Seo;
use App\Models\BaseModel as Model;
use App\Observers\SeoActionsObserver;

class News extends Model
{
    use Seo;
    
	protected $table = 'news';
	protected $fillable = [
		'thumbnail',
		'image',
		'category_id',
		'doctor_id',
		'publish_date',
		'created_at',
		'updated_at',
	];
    public $timestamps = false;



	public function admin()
	{
		return $this->belongsTo(\App\User::class,'admin_id','id');
	}
	
	public function translations()
	{
		return $this->hasMany(\App\Models\NewsTran::class,'news_id','id');
	}

    /**
     * @return mixed
     */
    public function translation()
    {
    	
    	return $this->belongsTo(\App\Models\NewsTran::class,'id','news_id')
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
        News::observe(new SeoActionsObserver());
    }
}