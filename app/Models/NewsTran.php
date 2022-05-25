<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class NewsTran extends Model
{
	protected $connection = 'mysql';
	protected $table = 'news_trans';

	protected $fillable = [
		'news_id',
		'locale',
		'title',
		'content'
	];
}
