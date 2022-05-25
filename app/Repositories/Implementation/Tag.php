<?php

namespace App\Repositories\Implementation;

use App\Models\Tag as TagModel;
use App\Models\TagTran as TagTranModel;
use App\Models\TagRelated as TagRelatedModel;
use App\Services\Api\Response as ResponseService;
use App\Repositories\Contracts\Tag as TagInterface;
use App\Services\Transformation\Tag as TagTransformation;
use App\Services\Bridge\Seo as SeoService;
use Carbon\Carbon;
use DB;
use LaravelLocalization;

class Tag implements TagInterface
{
    protected $tagModel;
    protected $tagTranModel;
    protected $tagRelatedModel;
    protected $tagTransform;
    protected $message;
    protected $lastInsertId;
    protected $response;
    protected $seoManager;

    function __construct(
        TagModel $tagModel, 
        TagTranModel $tagTranModel, 
        TagTransformation $tagTransform,  
        ResponseService $response, 
        TagRelatedModel $tagRelatedModel,
        SeoService $seoManager)
    {

        $this->response = $response;
        $this->tagModel = $tagModel;
        $this->tagRelatedModel = $tagRelatedModel;
        $this->seoManager = $seoManager;
        $this->tagTranModel = $tagTranModel;
        $this->tagTransform = $tagTransform;
    }
    
    /** 
     * get data
     * @param $data
     * @return array
     */

    public function getFrontData($params)
    {
        try {
            //code...

            return $this->tagTransform->getFrontData($this->tagManager($params));
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    /** 
     * get data
     * @param $data
     * @return array
     */

    public function getDataCms($params)
    {
        try {
            //code...
            
            return $this->tagTransform->getDataCms($this->tagManager($params));
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    /** 
     * get data
     * @param $data
     * @return array
     */

    public function editDataCms($requestId)
    {
        try {
            //code...
            // $data['seo'] = $this->seoManager->getEdit(['id' => $requestId, 'type'=>'Tag']);
            $data['data'] = $this->tagTransform->getSingleDataCms($this->tagManager(['id' => $requestId], 'asc', 'array', true));
            return $this->response->setResponse('Success get data', true, $data);
            
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    /** 
     * get data
     * @param $data
     * @return array
     */

    public function storeDataCms($params)
    {
        try {
            //code...
            DB::beginTransaction();

            if(isset($params['id'])) {
                $store = $this->tagModel->find($params['id']);
            } else {
                $store = $this->tagModel;
                $store->created_at = Carbon::now();
                $store->slug = isset($params['title']['id']) ? str_slug($params['title']['id']) : str_slug($params['title']['en']);
            }
            
            if($store->save()) {
                
                if($this->storeDataTranslationCms($params, $store->id)) {

                    DB::commit();
                    return $this->response->setResponse('Success save data', true);
                }
                
                DB::rollBack();
                return $this->response->setResponse($this->message, false);
                    
            }
                
            DB::rollBack();
            return $this->response->setResponse($this->message, false);
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->message = $e->getMessage();
        }
    }

    /** 
     * get data
     * @param $data
     * @return array
     */

    protected function storeDataTranslationCms($params, $categoryId)
    {
        try {
            //code...

            if(isset($params['id'])) {

                $this->tagTranModel->where('tag_id', $params['id'])->delete();
            }

            $transData = [];

            $suportLocale = LaravelLocalization::getSupportedLocales();

            foreach($suportLocale as $key=> $locale) {
                $transData[$key] = [
                    'locale' => $key,
                    'tag_id' => isset($params['id']) ? $params['id'] : $categoryId,
                    'title' => isset($params['title'][$key]) ? $params['title'][$key] : '',
                    'created_at' => Carbon::now()
                ];
            }

            if($this->tagTranModel->insert($transData))
                return true;

            return false;

        } catch (\Exception $e) {
            
            $this->message = $e->getMessage();
            return false;
        }
    }

    /**
     * Get All CarRental
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function tagManager($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        try {

            //code...
            $el = $this->tagModel->with(['translation', 'translations', 'type']);
            // dd($params);
            if(isset($params['slug']))
                $el->where('slug',$params['slug']);
                
            if(isset($params['id']))
                $el->where('id',$params['id']);

            if(isset($params['limit']))
                $el->take($params['limit']);

            if(isset($params['type']) && !empty($params['type'])) {
                $model = ucfirst($params['type']);
                $class = "App\\Models\\$model";
                
                $el->with(['type' => function($q) use($class) {
                    
                    $q->where(function ($query) use ($class) {
                        $query->where('key_type',$class);
                    });
                }]);
            }
            
            if(!$el->count())
                return array();

            switch ($returnType) {
                case 'array':
                    if(!$returnSingle) {
                        return $el
                        ->get()->toArray();
                    } else {
                        return $el
                        ->first()->toArray();
                    }
                    break;
            }

        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

}