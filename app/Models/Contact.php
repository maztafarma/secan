<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class Contact extends Model
{
	
	protected $table = 'contact';
	protected $fillable = [
		'fullname',
		'email',
		'message',
	];
    public $timestamps = true;

}