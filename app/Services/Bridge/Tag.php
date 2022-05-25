<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Tag as TagInterface;

class Tag {

    /**
     * @var Tag Interface
     */
    protected $tagManager;

    public function __construct(TagInterface $tagManager)
    {
        $this->tagManager = $tagManager;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getFrontData($params = array())
    {
        return $this->tagManager->getFrontData($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getDataCms($params = array())
    {
        return $this->tagManager->getDataCms($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function editDataCms($bannerId)
    {
        return $this->tagManager->editDataCms($bannerId);   
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function storeDataCms($params = array())
    {
        return $this->tagManager->storeDataCms($params);   
    }

}