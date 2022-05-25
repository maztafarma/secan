<?php

namespace App\Models;
use App\Models\BaseModel as Model;

class NewsComment extends Model
{
   
	protected $table = 'news_comment';
	protected $fillable = [
		'news_id',
		'fullname',
		'phone_number',
		'website_url',
		'comment',
		'created_at'
	];
    public $timestamps = true;
}