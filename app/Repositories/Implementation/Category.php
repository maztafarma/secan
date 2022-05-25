<?php

namespace App\Repositories\Implementation;

use App\Models\Category as CategoryModel;
use App\Models\CategoryTran as CategoryTranModel;
use App\Services\Api\Response as ResponseService;
use App\Repositories\Contracts\Category as CategoryInterface;
use App\Services\Transformation\Category as CategoryTransformation;
use Carbon\Carbon;
use DB;
use LaravelLocalization;

class Category implements CategoryInterface
{
    protected $categoryModel;
    protected $categoryTranModel;
    protected $categoryTransform;
    protected $message;
    protected $lastInsertId;
    protected $response;

    function __construct(CategoryModel $categoryModel, CategoryTranModel $categoryTranModel, CategoryTransformation $categoryTransform,  
    ResponseService $response)
    {

        $this->response = $response;
        $this->categoryModel = $categoryModel;
        $this->categoryTranModel = $categoryTranModel;
        $this->categoryTransform = $categoryTransform;
    }

    /** 
     * get data
     * @param $data
     * @return array
     */

    public function getData($params)
    {
        try {
            //code...

            return $this->categoryTransform->getData($this->categoryManager($params));
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
            
            return $this->categoryTransform->getDataCms($this->categoryManager($params));
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
            $data = $this->categoryTransform->getSingleDataCms($this->categoryManager(['id' => $requestId], 'asc', 'array', true));
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
                $store = $this->categoryModel->find($params['id']);
            } else {
                $store = $this->categoryModel;
                $store->slug = isset($params['title']['id']) ? str_slug($params['title']['id']) : str_slug($params['title']['en']);
            }
            
            $store->created_at = Carbon::now();
            
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

                $this->categoryTranModel->where('category_id', $params['id'])->delete();
            }

            $transData = [];

            $suportLocale = LaravelLocalization::getSupportedLocales();

            foreach($suportLocale as $key=> $locale) {
                $transData[$key] = [
                    'locale' => $key,
                    'category_id' => isset($params['id']) ? $params['id'] : $categoryId,
                    'title' => isset($params['title'][$key]) ? $params['title'][$key] : '',
                    'created_at' => Carbon::now()
                ];
            }

            if($this->categoryTranModel->insert($transData))
                return true;

            return false;

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

            $model = $this->categoryModel->find($params['id']);

            if($model) {
                $model->delete();
                $this->categoryTranModel->where('category_id', $params['id'])->delete();

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
    protected function categoryManager($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        try {

            //code...
            $el = $this->categoryModel->with(['translation', 'translations']);

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

        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

}