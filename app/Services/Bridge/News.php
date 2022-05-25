<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\News as NewsInterface;

class News {

    /**
     * @var Banner Interface
     */
    protected $newsManager;

    public function __construct(NewsInterface $newsManager)
    {
        $this->newsManager = $newsManager;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getHomeData($params = array())
    {
        return $this->newsManager->getHomeData($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getHomeDetail($params = array())
    {
        return $this->newsManager->getHomeDetail($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getCommentData($params = array())
    {
        return $this->newsManager->getCommentData($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function storeCommentData($params = array())
    {
        return $this->newsManager->storeCommentData($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getDataCms($params = array())
    {
        return $this->newsManager->getDataCms($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function editDataCms($bannerId)
    {
        return $this->newsManager->editDataCms($bannerId);   
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function storeDataCms($params = array())
    {
        return $this->newsManager->storeDataCms($params);   
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function deleteDataCms($params = array())
    {
        return $this->newsManager->deleteDataCms($params);   
    }

} 