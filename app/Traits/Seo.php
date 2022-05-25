<?php

namespace App\Traits;
use App\Services\Bridge\News as MewsServices;
use Route;

trait Seo
{
    
	public function seo()
    {
        return $this->morphMany(\App\Models\Seo::class, 'key')->with('translations');   
    }
}