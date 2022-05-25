<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Contact as ContactInterface;

class Contact {

    /**
     * @var Banner Interface
     */
    protected $contactManager;

    public function __construct(ContactInterface $contactManager)
    {
        $this->contactManager = $contactManager;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function storeContact($params = array())
    {
        return $this->contactManager->storeContact($params);
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function storeSubscribe($params = array())
    {
        return $this->contactManager->storeSubscribe($params);
    }

} 