<?php

namespace App\Repositories\Contracts;


interface Contact
{

    /**
     * @param $params
     * @return mixed
     */
    public function storeContact($params);

    /**
     * @param $params
     * @return mixed
     */
    public function storeSubscribe($params);

} 