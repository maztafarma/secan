<?php
namespace App\Repositories\Implementation;

use App\Repositories\Contracts\Seo as SeoInterface;
use App\Services\Transformation\Seo as SeoTransformation;
use App\Models\Seo as SeoModel;
use App\Models\SeoTran as SeoTransModel;
use App\Models\Pages as PagesModel;
use App\Services\Api\Response as ResponseService;
use DB;


class Seo implements SeoInterface
{

    protected $seo;
    protected $pages;
    protected $seoTrans;
    protected $seoTransformation;
    protected $message;
    protected $insertId;
    protected $lastSeoId;
    protected $response;

    protected $exceptIndexPost = [
        '_token'
    ];

    function __construct(SeoModel $seo, PagesModel $pages, SeoTransModel $seoTrans
        , SeoTransformation $seoTransformation, ResponseService $response)
    {
        $this->seo                  = $seo;
        $this->response             = $response;
        $this->pages                = $pages;
        $this->seoTrans             = $seoTrans;
        $this->seoTransformation    = $seoTransformation;
    }

    public function getData($params)
    {
        $data = $this->pages->get();
        // foreach($data as $key => $obj)
        //     $data[$key]['route'] = route($obj['route']);

        return $data;
    }

    public function getEdit($data)
    {
        try {
            
            if(empty($data))
                return $this->response->setResponse($this->message, false);

            $params = [
                "key_id"       => $data['id'],
                "key_type"     => "App\Models\\".$data['type'],
            ];

            $seoDataEdit =  $this->seo($params, 'asc', 'array', true);
            return $this->seoTransformation->getEditSeoCmsTransform($seoDataEdit);

            } catch (\Exception $e) {
            return $this->response->setResponse($e->getMessage(), false);
        }
    }


    public function getEditPages($params)
    {
        try {
            if(empty($params))
                return $this->response->setResponse($this->message, false);

            $seoDataEdit =  $this->seoPages($params, 'asc', 'array', true);
            
            return $this->seoTransformation->getEditPagesCmsTransform($seoDataEdit);

            } catch (\Exception $e) {
            return $this->response->setResponse($e->getMessage(), false);
        }

    }

    protected function seoPages($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $pages = $this->pages->with(['seo']);
          
        if(isset($params['id'])) {
            $pages->where('id', $params['id']);
        }
          
        if(isset($params['route_name'])) {
            $pages->where('route', $params['route_name']);
        }

       
        if(!$pages->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $pages->get()->toArray();
                } else {
                    return $pages->first()->toArray();
                }
                break;
        }
    }



    /**
     * Get All Seo
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function seo($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        $seo = $this->seo
                     ->with(['translation', 'translations']);
          
        if(isset($params['key_id']) && isset($params['key_type'])) {
            $seo->where('key_id', $params['key_id'])
                ->where('key_type', $params['key_type']);
        }

       
        if(!$seo->count())
            return array();

        switch ($returnType) {
            case 'array':
                if(!$returnSingle) {
                    return $seo->get()->toArray();
                } else {
                    return $seo->first()->toArray();
                }
                break;
        }
    }


    public function getStore($data, $class = '')
    {

        if(empty($data) || $data == null)
            return false;
        
        try 
        {
            $key_id = $data['id'];
            DB::beginTransaction();
            if ($this->storeSeo($data, $key_id, $class) != true) {
                DB::rollBack();
                return $this->response->setResponse($this->message, false);
            }

            if ($this->storeSeoTranslation($data) != true) {
                DB::rollBack();
                return $this->response->setResponse($this->message, false);
            }

            DB::commit();
            return $this->response->setResponse(trans('message.cms_success_store_data_general'), true);

        }
        catch(\Exception $e)
        {
            return $this->response->setResponse($e->getMessage(), false);
        }   
    }


    private function storeSeo($data, $key_id, $class = '')
    {
        try {
            if(!$class)
            {
                $model = ucfirst($data['type_seo']);
                $class = "App\\Models\\$model";
            }
            $object = $class::find($key_id);
            
            if($object)
            {
                if($object->seo()->first())
                {
                    $this->lastSeoId = $object->seo()->first()->id;
                    $object->seo()->delete();
                }

                $seoData = $this->seo;
                if($save = $object->seo()->save($seoData))
                {
                    $this->insertId = $seoData->id;
                }
                return $save;
            }
            return false;
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }

    }

    private function storeSeoTranslation($data)
    {
        if ($this->isEditMode($data)) {
            $this->removeSeoTranslation($this->lastSeoId);
        }

        $finalData = $this->seoTransformation->getSaveSeoCmsTransform($data, $this->insertId, $this->isEditMode($data));
        return $this->seoTrans->insert($finalData);
    }

    private function removeSeoTranslation($id)
    {
        if (empty($id))
            return false;

        $delete = SeoTransModel::where('seo_id', $id)->delete();
        if($delete){
            return true;
        }else{
            return false;
        }

    }

    protected function isEditMode($data)
    {
        return isset($this->lastSeoId) && !empty($this->lastSeoId) ? true : false;
    }

    public function getSeo($params)
    {
        if(empty($params) || $params == null)
            return false;

        $data = $this->pages->find($params);
        if($data)
        {
            return $data;
        }else{
            return false;
        }
    }

}
