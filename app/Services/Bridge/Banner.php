<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Banner as BannerInterface;

class Banner {

    /**
     * @var Banner Interface
     */
    protected $bannerManager;

    public function __construct(BannerInterface $bannerManager)
    {
        $this->bannerManager = $bannerManager;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getHomeSlide($params = array())
    {
        return $this->bannerManager->getHomeSlide($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getDataCms($params = array())
    {
        return $this->bannerManager->getDataCms($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function editDataCms($bannerId)
    {
        return $this->bannerManager->editDataCms($bannerId);   
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function storeDataCms($params = array())
    {
        return $this->bannerManager->storeDataCms($params);   
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function deleteDataCms($params = array())
    {
        return $this->bannerManager->deleteDataCms($params);   
    }

} 