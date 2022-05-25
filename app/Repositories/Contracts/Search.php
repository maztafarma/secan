<?php

namespace App\Repositories\Contracts;


interface Search
{

    /**
     * @param $params
     * @return mixed
     */
    public function getResult($params);

}