<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class Doctor extends Model
{
	
	protected $table = 'doctor';
	protected $fillable = [
		'foto',
		'fullname',
		'location'
	];
    public $timestamps = false;


	public function informations()
	{
		return $this->hasMany(\App\Models\DoctorInformation::class,'doctor_id','id');
	}


	public function artikel()
	{
		return $this->hasMany(\App\Models\News::class,'doctor_id','id');
	}

    /**
     * @return mixed
     */
    public function information()
    {
    	
    	return $this->belongsTo(\App\Models\DoctorInformation::class,'id','doctor_id')
            ->where('locale', '=' , $this->getCurrentLocalize());
    }

    /**
     * @return mixed
     */
    public function category()
    {
    	
    	return $this->belongsTo(\App\Models\Category::class,'category_id','id');
    }

}