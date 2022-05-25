<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class VideoTran extends Model
{
	protected $connection = 'mysql';
	protected $table = 'video_trans';

	protected $fillable = [
		'video_id',
		'locale',
		'title',
        'created_at',
        'updated_at'
	];
}
