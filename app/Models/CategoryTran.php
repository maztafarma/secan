<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class CategoryTran extends Model
{
	protected $connection = 'mysql';
	protected $table = 'category_trans';

	protected $fillable = [
		'category_id',
		'locale',
		'title'
	];
}
