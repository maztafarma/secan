<?php

namespace App\Repositories\Implementation;

use App\Models\Video as VideoModel;
use App\Models\VideoTran as VideoTranModel;
use App\Services\Api\Response as ResponseService;
use App\Repositories\Contracts\Video as VideoInterface;
use App\Services\Transformation\Video as VideoTransformation;
use App\Services\Bridge\Seo as SeoService;
use Carbon\Carbon;
use DB;
use LaravelLocalization;

class Video implements VideoInterface
{
    protected $videoModel;
    protected $videoTranModel;
    protected $videoTransform;
    protected $message;
    protected $lastInsertId;
    protected $response;
    protected $seoManager;

    use \App\Traits\TagRelated;

    function __construct(VideoModel $videoModel, VideoTranModel $videoTranModel, VideoTransformation $videoTransform,  
    ResponseService $response, SeoService $seoManager)
    {

        $this->response = $response;
        $this->videoModel = $videoModel;
        $this->seoManager = $seoManager;
        $this->videoTranModel = $videoTranModel;
        $this->videoTransform = $videoTransform;
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

            return $this->videoTransform->getFrontData($this->videoManager($params));
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

    public function getFrontDetail($params)
    {
        try {
            //code...

            return $this->videoTransform->getFrontDetail($this->videoManager($params, 'asc', 'array', true));
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
            
            return $this->videoTransform->getDataCms($this->videoManager($params));
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
            $data['seo'] = $this->seoManager->getEdit(['id' => $requestId, 'type'=>'Video']);
            $data['data'] = $this->videoTransform->getSingleDataCms($this->videoManager(['id' => $requestId], 'asc', 'array', true));
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
                $store = $this->videoModel->find($params['id']);
                $store->updated_at = Carbon::now();
            } else {
                $store = $this->videoModel;
                $store->created_at = Carbon::now();
                $store->publish_date = Carbon::now();
                $store->slug = isset($params['title']['id']) ? str_slug($params['title']['id']) : str_slug($params['title']['en']);
            }
            
            $store->youtube_url = isset($params['youtube_url']) ? $params['youtube_url'] : '';
            $store->category_id = isset($params['category_id']) ? $params['category_id'] : '';
            $store->doctor_id = isset($params['doctor_id']) ? $params['doctor_id'] : NULL;
            
            if(isset($params['thumbnail']) && !empty($params['thumbnail']))
                $store->thumbnail = strtolower(str_replace(' ', '_', $params['thumbnail']->getClientOriginalName()));
            else
                $store->thumbnail = isset($params['old_thumbnail']) ? $params['old_thumbnail'] : '';
            
            if(isset($params['home_thumbnail']) && !empty($params['home_thumbnail']))
                $store->home_thumbnail = strtolower(str_replace(' ', '_', $params['home_thumbnail']->getClientOriginalName()));
            else
                $store->home_thumbnail = isset($params['old_home_thumbnail']) ? $params['old_home_thumbnail'] : '';
            
            if($store->save()) {
                
                if($this->storeDataTranslationCms($params, $store->id)) {

                    if($this->imageUploader($params)) {

                        if(isset($params['tag_id']) && !empty($params['tag_id'])) {

                            if(!$this->storeTagRelated($params, $store->id)) {
                                DB::rollBack();
                                return $this->response->setResponse($this->message, false);
                            }
                        }

                        DB::commit();
                        return $this->response->setResponse('Success save data', true);
                    }

                    DB::rollBack();
                    return $this->response->setResponse($this->message, false);
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

                $this->videoTranModel->where('video_id', $params['id'])->delete();
            }

            $transData = [];

            $suportLocale = LaravelLocalization::getSupportedLocales();

            foreach($suportLocale as $key=> $locale) {
                $transData[$key] = [
                    'locale' => $key,
                    'video_id' => isset($params['id']) ? $params['id'] : $categoryId,
                    'title' => isset($params['title'][$key]) ? $params['title'][$key] : '',
                    'created_at' => Carbon::now()
                ];
            }

            if($this->videoTranModel->insert($transData))
                return true;

            return false;

        } catch (\Exception $e) {
            
            $this->message = $e->getMessage();
            return false;
        }
    }

    protected function imageUploader($params)
    {
        try {
            //code...

            if (isset($params['thumbnail']) && !empty($params['thumbnail'])) {
                if ($params['thumbnail']->isValid()) {
                    
                    $thumbnail = strtolower(str_replace(' ', '_', $params['thumbnail']->getClientOriginalName()));
                    
                    if (!$params['thumbnail']->move('./' . VIDEO_DIR, $thumbnail)) {
                        
                        $this->message = 'failed upload thumbnail';
                        return false;
                    }
                }
                else {
                    $this->message = $params['thumbnail']->getErrorMessage();
                    return false;
                }
            }

            if (isset($params['home_thumbnail']) && !empty($params['home_thumbnail'])) {
                if ($params['home_thumbnail']->isValid()) {
                    
                    $home_thumbnail = strtolower(str_replace(' ', '_', $params['home_thumbnail']->getClientOriginalName()));
                    
                    if (!$params['home_thumbnail']->move('./' . VIDEO_DIR, $home_thumbnail)) {
                        
                        $this->message = 'failed upload home thumbnail';
                        return false;
                    }
                }
                else {
                    $this->message = $params['home_thumbnail']->getErrorMessage();
                    return false;
                }
            }
    
            return true;

        } catch (\Exception $e) {
            
            $this->message = $e->getMessage();
            return false;
        }
        
    }

    /** 
     * delete data
     * @param $data
     * @return array
     */

    public function deleteDataCms($params)
    {
        try {

            //code...

            DB::beginTransaction();

            $model = $this->videoModel->find($params['id']);

            if($model) {
                $model->delete();
                $this->videoTranModel->where('video_id', $params['id'])->delete();

                DB::commit();
                return $this->response->setResponse('Success delete data', true);
            }

            DB::rollBack();
            return $this->response->setResponse($this->message, false);
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->message = $e->getMessage();
        }
    }

    /**
     * Get All CarRental
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function videoManager($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        try {

            //code...
            $el = $this->videoModel->with(['translation', 'translations', 'category', 'category.translation', 'tags', 'doctor']);

            if(isset($params['category_slug'])) {
                $el->whereHas('category', function($q) use($params) {
                    $q->where('slug', $params['category_slug']);
                });
            }
            
            if(isset($params['tag_slug'])) {
                $el->with(['tags.tag' => function($q) use($params) {
                    $q->where('slug', $params['tag_slug']);
                }]);
            }

            if(isset($params['video_article'])) {
                $el->where('doctor_id', '!=', null);
            } 
            
            if(isset($params['slug']))
                $el->where('slug',$params['slug']);
                
            if(isset($params['doctor_id']))
                $el->where('doctor_id',$params['doctor_id']);
            
            if(isset($params['related_slug']))
                $el->where('slug','!==', $params['related_slug']);

            if(isset($params['category_id']))
                $el->where('category_id',$params['category_id']);
                
            if(isset($params['id']))
                $el->where('id',$params['id']);

            if(isset($params['limit']))
                $el->take($params['limit']);

            if(isset($params['order_by'])) {
                $el
                ->orderBy($params['order_by'], (isset($params['order_type']) ? $params['order_type'] : $orderType));
            } 
            else if(isset($params['order_type'])) {
                $el->orderBy('publish_date', $params['order_type']);
            } else {
                $el
                ->orderBy('publish_date', (isset($params['order_type']) ? $params['order_type'] : $orderType));
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