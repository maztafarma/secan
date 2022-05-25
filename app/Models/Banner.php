<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class Banner extends Model
{
	
	protected $table = 'banner';
	protected $fillable = [
		'image',
		'created_at'
	];
    public $timestamps = false;


	public function translations()
	{
		return $this->hasMany(\App\Models\BannerTran::class,'banner_id','id');
	}

    /**
     * @return mixed
     */
    public function translation()
    {
    	
    	return $this->belongsTo(\App\Models\BannerTran::class,'id','banner_id')
            ->where('locale', '=' , $this->getCurrentLocalize());
    }
}