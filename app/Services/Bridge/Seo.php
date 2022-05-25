<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Seo as SeoInterface;

class Seo {

    /**
     * @var SeoInterface
     */
    protected $seo;

    public function __construct(SeoInterface $seo)
    {
        $this->seo = $seo;
    }

    public function getData($params = array())
    {
        return $this->seo->getData($params);
    }

    public function getStore($params = array())
    {
        return $this->seo->getStore($params);
    }

    public function getEdit($params = array())
    {
        return $this->seo->getEdit($params);
    }

    public function getEditPages($params = array())
    {
        return $this->seo->getEditPages($params);
    }

    public function getSeo($params = array())
    {
        return $this->seo->getSeo($params);
    }

}