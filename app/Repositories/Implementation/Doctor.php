<?php

namespace App\Repositories\Implementation;

use App\Models\Doctor as DoctorModel;
use App\Models\DoctorInformation as DoctorInformationModel;
use App\Services\Api\Response as ResponseService;
use App\Repositories\Contracts\Doctor as DoctorInterface;
use App\Services\Transformation\Doctor as DoctorTransformation;
use Carbon\Carbon;
use DB;
use LaravelLocalization;

class Doctor implements DoctorInterface
{
    protected $doctorModel;
    protected $doctorInformationModel;
    protected $doctorTransform;
    protected $message;
    protected $lastInsertId;
    protected $response;

    function __construct(DoctorModel $doctorModel, DoctorInformationModel $doctorInformationModel, DoctorTransformation $doctorTransform,  
    ResponseService $response)
    {

        $this->response = $response;
        $this->doctorModel = $doctorModel;
        $this->doctorInformationModel = $doctorInformationModel;
        $this->doctorTransform = $doctorTransform;
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

            return $this->doctorTransform->getData($this->doctorManager($params));
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

            return $this->doctorTransform->getDataCms($this->doctorManager($params));
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
            
            $data = $this->doctorTransform->getSingleDataCms($this->doctorManager(['id' => $requestId], 'asc', 'array', true));
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
                $store = $this->doctorModel->find($params['id']);
                $store->updated_at = Carbon::now();
                
            } else {
                $store = $this->doctorModel;
                $store->created_at = Carbon::now();
            }
            
            $store->category_id = isset($params['category_id']) ? $params['category_id'] : '';
            $store->fullname = isset($params['fullname']) ? $params['fullname'] : '';
            $store->location = isset($params['location']) ? $params['location'] : '';
            $store->longitude = isset($params['longitude']) ? $params['longitude'] : '';
            $store->latitude = isset($params['latitude']) ? $params['latitude'] : '';
            $store->address = isset($params['address']) ? $params['address'] : '';
            $store->phone_number = isset($params['phone_number']) ? $params['phone_number'] : '';
            
            if(isset($params['foto']) && !empty($params['foto']))
                $store->foto = strtolower(str_replace(' ', '_', $params['foto']->getClientOriginalName()));
            else
                $store->foto = isset($params['old_foto']) ? $params['old_foto'] : '';
            
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

    protected function storeDataTranslationCms($params, $doctorId)
    {
        try {
            //code...

            if(isset($params['id'])) {

                $this->doctorInformationModel->where('doctor_id', $params['id'])->delete();
            }

            $transData = [];

            $suportLocale = LaravelLocalization::getSupportedLocales();

            foreach($suportLocale as $key=> $locale) {
                $transData[$key] = [
                    'locale' => $key,
                    'doctor_id' => isset($params['id']) ? $params['id'] : $doctorId,
                    'description' => isset($params['description'][$key]) ? $params['description'][$key] : '',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            if($this->doctorInformationModel->insert($transData))
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
            
            if (isset($params['foto']) && !empty($params['foto'])) {
                if ($params['foto']->isValid()) {
                    
                    $foto = strtolower(str_replace(' ', '_', $params['foto']->getClientOriginalName()));
                    
                    if (!$params['foto']->move('./' . DOCTOR_DIR, $foto)) {
                        
                        $this->message = 'failed upload foto';
                        return false;
                    }
                }
                else {
                    $this->message = $params['foto']->getErrorMessage();
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

            $model = $this->doctorModel->find($params['id']);

            if($model) {

                $model->delete();
                $this->doctorInformationModel->where('doctor_id', $params['id'])->delete();
                
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
    protected function doctorManager($params = array(), $orderType = 'desc', $returnType = 'array', $returnSingle = false)
    {
        try {

            //code...
            $el = $this->doctorModel->with(['information', 'informations', 'category', 'category.translation', 'artikel']);
            
            if(isset($params['category_slug'])) {
                $el->whereHas('category', function($q) use($params) {
                    $q->where('slug', $params['category_slug']);
                });
            }
            
            if(isset($params['id']))
                $el->where('id',$params['id']);

            if(isset($params['limit']))
                $el->take(0, $params['limit']);

            if(isset($params['filter'])) {

                switch ($params['filter']) {
                    case 'name':
                        $el->orderBy('fullname', 'asc');
                        break;
                    case 'area':
                        $el->orderBy('location', 'asc');
                        break;
                }
            }
            
            if(isset($params['order_by'])) {
                $el
                ->orderBy($params['order_by'], $orderType);
            } else {
                $el
                ->orderBy('fullname', 'asc');
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