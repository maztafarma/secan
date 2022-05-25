<?php

namespace App\Repositories\Contracts;


interface Seo
{
	public function getData($params);
    public function getStore($params);
    public function getEditPages($params);
    public function getEdit($params);
    public function getSeo($params);
}
