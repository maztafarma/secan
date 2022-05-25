<?php
namespace App\Observers;

use App\Repositories\Implementation\Seo as SeoServices;
use App\Services\Transformation\Seo as SeoTransformation;
use App\Models\Seo as SeoModel;
use App\Models\SeoTran as SeoTransModel;
use App\Models\Pages as PagesModel;
use App\Services\Api\Response as ResponseService;


class SeoActionsObserver
{
    
    protected $seoService;
    function __construct()
    {
        $this->seoService = new SeoServices(new SeoModel, new PagesModel,new SeoTransModel
        ,new SeoTransformation, new ResponseService);
    }

    public function saved($model)
    {
        if(request()->has('seo'))
        {
            $seo = request()->get('seo');
            $seo['id'] = $model->id;
            $this->seoService->getStore($seo, get_class($model));
        }
       
       
    }

    public function deleting($model)
    {
        
    }
}