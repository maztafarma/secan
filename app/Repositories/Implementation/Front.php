<?php
namespace App\Repositories\Implementation;

use App\Repositories\Contracts\Front as FrontInterface;
use App\Services\Transformation\Seo as SeoTransformation;
use App\Services\Bridge\News as NewsService;
use App\Services\Bridge\Video as VideoService;
use App\Models\Pages as PagesModel;
use App\Services\Bridge\Seo as SeoService;



class Front implements FrontInterface
{
    use \App\Traits\Meta;

    protected $pageModel;
    protected $seoManager;
    protected $newsManager;
    protected $videoManager;
    protected $seoFrontTransform;

    function __construct(
        SeoService $seoManager, 
        PagesModel $pageModel, 
        NewsService $newsManager, 
        VideoService $videoManager,
        SeoTransformation $seoFrontTransform)
    {

        $this->pageModel = $pageModel;
        $this->newsManager = $newsManager;
        $this->videoManager = $videoManager;
        $this->seoManager = $seoManager;
        $this->seoFrontTransform = $seoFrontTransform;
    }
    
}