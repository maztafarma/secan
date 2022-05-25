<?php

namespace App\Repositories\Contracts;


interface Tag
{
    
    /**
     * @param $params
     * @return mixed
     */
    public function getFrontData($params);

    /**
     * @param $params
     * @return mixed
     */
    public function getDataCms($params);

    /**
     * @param $params
     * @return mixed
     */
    public function editDataCms($params);

    /**
     * @param $params
     * @return mixed
     */
    public function storeDataCms($params);

}