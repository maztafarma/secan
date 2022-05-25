<?php

namespace App\Repositories\Implementation;

use App\Models\Banner as BannerModel;
use App\Models\BannerTran as BannerTranModel;
use App\Services\Api\Response as ResponseService;
use App\Repositories\Contracts\Banner as BannerInterface;
use App\Services\Transformation\Banner as BannerTransformation;
use Carbon\Carbon;
use DB;
use LaravelLocalization;

class Banner implements BannerInterface
{
    protected $bannerModel;
    protected $bannerTranModel;
    protected $bannerTransform;
    protected $message;
    protected $lastInsertId;
    protected $response;

    function __construct(BannerModel $bannerModel, BannerTranModel $bannerTranModel, BannerTransformation $bannerTransform,  
    ResponseService $response)
    {

        $this->response = $response;
        $this->bannerModel = $bannerModel;
        $this->bannerTranModel = $bannerTranModel;
        $this->bannerTransform = $bannerTransform;
    }

    /** 
     * get data
     * @param $data
     * @return array
     */

    public function getHomeSlide($params)
    {
        try {
            //code...

            return $this->bannerTransform->getListDataCms($this->bannerManager($params));
        } catch (\Exception $e) {
            return $this->response->setResponse($e->getMessage(), false);
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

            return $this->bannerTransform->getListDataCms($this->bannerManager($params));
        } catch (\Exception $e) {
            return $this->response->setResponse($e->getMessage(), false);
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
            $data = $this->bannerTransform->getSingleDataCms($this->bannerManager(['id' => $requestId], 'asc', 'array', true));
            return $this->response->setResponse('Success get data', true, $data);
            
        } catch (\Exception $e) {
            return $this->response->setResponse($e->getMessage(), false);
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

            if(isset($params['id']))
                $store = $this->bannerModel->find($params['id']);
            else
                $store = $this->bannerModel;
            
            $store->created_at = Carbon::now();
            
            if(isset($params['image']) && !empty($params['image']))
                $store->image = strtolower(str_replace(' ', '_', $params['image']->getClientOriginalName()));
            else
                $store->image = isset($params['old_image']) ? $params['old_image'] : '';
            
            if($store->save()) {
                
                if($this->storeDataTranslationCms($params, $store->id)) {

                    if($this->imageUploader($params)) {
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
            return $this->response->setResponse($e->getMessage(), false);
        }
    }

    /** 
     * get data
     * @param $data
     * @return array
     */

    protected function storeDataTranslationCms($params, $bannerId)
    {
        try {
            //code...

            if(isset($params['id'])) {

                $this->bannerTranModel->where('banner_id', $params['id'])->delete();
            }

            $transData = [];

            $suportLocale = LaravelLocalization::getSupportedLocales();

            foreach($suportLocale as $key=> $locale) {
                $transData[$key] = [
                    'locale' => $key,
                    'banner_id' => isset($params['id']) ? $params['id'] : $bannerId,
                    'title' => isset($params['title'][$key]) ? $params['title'][$key] : '',
                    'created_at' => Carbon::now()
                ];
            }

            if($this->bannerTranModel->insert($transData))
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

            if (isset($params['image']) && !empty($params['image'])) {
                if ($params['image']->isValid()) {
                    
                    $filename = strtolower(str_replace(' ', '_', $params['image']->getClientOriginalName()));
                    
                    if (!$params['image']->move('./' . BANNER_DIR, $filename)) {
                        
                        $this->message = 'failed upload image';
                        return false;
                    }
                }
                else {
                    $this->message = $params['image']->getErrorMessage();
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

            $model = $this->bannerModel->find($params['id']);

            if($model) {
                $model->delete();
                $this->bannerTranModel->where('banner_id', $params['id'])->delete();

                DB::commit();
                return $this->response->setResponse('Success delete data', true);
            }

            DB::rollBack();
            return $this->response->setResponse($this->message, false);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response->setResponse($e->getMessage(), false);
        }
    }

    /**
     * Get All CarRental
     * Warning: this function doesn't redis cache
     * @param array $params
     * @return array
     */
    protected function bannerManager($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        try {

            //code...
            $el = $this->bannerModel->with(['translation', 'translations']);

            if(isset($params['id']))
                $el->where('id',$params['id']);

            if(isset($params['order_by'])) {
                $el
                ->orderBy($params['order_by'], $orderType);
            } else {
                $el
                ->orderBy('created_at', $orderType);
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

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}