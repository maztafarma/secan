<?php

namespace App\Repositories\Contracts;


interface Banner
{

    /**
     * @param $params
     * @return mixed
     */
    public function getHomeSlide($params);

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