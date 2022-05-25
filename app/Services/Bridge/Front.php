<?php

namespace App\Services\Bridge;

use App\Repositories\Contracts\Front as FrontInterface;

class Front {

    /**
     * @var SeoInterface
     */
    protected $frontManager;

    public function __construct(FrontInterface $frontManager)
    {
        $this->frontManager = $frontManager;
    }

    public function generate_meta()
    {
        return $this->frontManager->generate_meta();
    }
}