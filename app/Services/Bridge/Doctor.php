<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Doctor as DoctorInterface;

class Doctor {

    /**
     * @var Banner Interface
     */
    protected $doctorManager;

    public function __construct(DoctorInterface $doctorManager)
    {
        $this->doctorManager = $doctorManager;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getData($params = array())
    {
        return $this->doctorManager->getData($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getDataCms($params = array())
    {
        return $this->doctorManager->getDataCms($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function editDataCms($doctorId)
    {
        return $this->doctorManager->editDataCms($doctorId);   
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function storeDataCms($params = array())
    {
        return $this->doctorManager->storeDataCms($params);   
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function deleteDataCms($params = array())
    {
        return $this->doctorManager->deleteDataCms($params);   
    }

} 