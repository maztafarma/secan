<?php

namespace App\Repositories\Contracts;


interface News
{

    /**
     * @param $params
     * @return mixed
     */
    public function getHomeData($params);

    /**
     * @param $params
     * @return mixed
     */
    public function getHomeDetail($params);
    
    /**
     * @param $params
     * @return mixed
     */
    public function getCommentData($params);
    /**
     * @param $params
     * @return mixed
     */
    public function storeCommentData($params);

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