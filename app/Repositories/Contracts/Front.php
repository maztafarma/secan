<?php

namespace App\Repositories\Contracts;


interface Front
{

    /**
     * @param $params
     * @return mixed
     */
    public function generate_meta();
    
}