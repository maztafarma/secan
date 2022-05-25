<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Category as CategoryInterface;

class Category {

    /**
     * @var Banner Interface
     */
    protected $categoryManager;

    public function __construct(CategoryInterface $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->categoryManager->getData($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getDataCms($params = array())
    {
        return $this->categoryManager->getDataCms($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function editDataCms($categoryId)
    {
        return $this->categoryManager->editDataCms($categoryId);   
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function storeDataCms($params = array())
    {
        return $this->categoryManager->storeDataCms($params);   
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function deleteDataCms($params = array())
    {
        return $this->categoryManager->deleteDataCms($params);   
    }

} 