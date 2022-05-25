<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class Category extends Model
{
	
	protected $table = 'category';
	protected $fillable = [
		'created_at'
	];
    public $timestamps = false;


	public function translations()
	{
		return $this->hasMany(\App\Models\CategoryTran::class,'category_id','id');
	}

    /**
     * @return mixed
     */
    public function translation()
    {
    	
    	return $this->belongsTo(\App\Models\CategoryTran::class,'id','category_id')
            ->where('locale', '=' , $this->getCurrentLocalize());
    }

}