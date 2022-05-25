<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Search as SearchInterface;

class Search {

    /**
     * @var Search Interface
     */
    protected $searchManager;

    public function __construct(SearchInterface $searchManager)
    {
        $this->searchManager = $searchManager;
    }
    
    /**
     * @param $params
     * @return mixed
     */
    public function getResult($params = array())
    {
        return $this->searchManager->getResult($params);
    }
}