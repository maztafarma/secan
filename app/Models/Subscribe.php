<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class Subscribe extends Model
{

	protected $table = 'subscribe';
	protected $fillable = [
		'fullname',
		'email'
	];
    public $timestamps = true;

}