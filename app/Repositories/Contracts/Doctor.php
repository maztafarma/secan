<?php

namespace App\Repositories\Contracts;


interface Doctor
{

    /**
     * @param $params
     * @return mixed
     */
    public function getData($params);

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

    /**
     * @param $params
     * @return mixed
     */
    public function deleteDataCms($params);

} 