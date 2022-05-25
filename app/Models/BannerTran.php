<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class BannerTran extends Model
{
	protected $connection = 'mysql';
	protected $table = 'banner_trans';

	protected $fillable = [
		'banner_id',
		'locale',
		'title'
	];

	public function banner()
	{
		return $this->belongsTo(\App\Models\Banner::class);
	}
}
