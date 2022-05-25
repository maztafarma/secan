<?php

namespace App\Repositories\Implementation;

use App\Models\Contact as ContactModel;
use App\Models\Subscribe as SubscribeModel;
use App\Services\Api\Response as ResponseService;
use App\Repositories\Contracts\Contact as ContactInterface;
use Carbon\Carbon;
use DB;
use LaravelLocalization;

class Contact implements ContactInterface
{
    protected $contactModel;
    protected $subscribeModel;
    protected $message;
    protected $lastInsertId;
    protected $response;

    function __construct(
        contactModel $contactModel,  
        SubscribeModel $subscribeModel,  
        ResponseService $response)
    {

        $this->response = $response;
        $this->contactModel = $contactModel;
        $this->subscribeModel = $subscribeModel;
    }

    /** 
     * get data
     * @param $data
     * @return array
     */

    public function storeContact($params)
    {
        try {
            //code...
            DB::beginTransaction();

            $store = $this->contactModel;
            
            $store->fullname = isset($params['fullname']) ? $params['fullname'] : '';
            $store->email = isset($params['email']) ? $params['email'] : '';
            $store->message = isset($params['message']) ? $params['message'] : '';
            
            if($store->save()) {
                
                DB::commit();
                return $this->response->setResponse('Success save data', true);
                    
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

    public function storeSubscribe($params)
    {
        try {
            //code...
            DB::beginTransaction();

            $store = $this->subscribeModel;
            
            $store->fullname = isset($params['fullname']) ? $params['fullname'] : '';
            $store->email = isset($params['email']) ? $params['email'] : '';
            
            if($store->save()) {
                
                DB::commit();
                return $this->response->setResponse('Success save data', true);
                    
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
    protected function contactManager($params = array(), $orderType = 'asc', $returnType = 'array', $returnSingle = false)
    {
        try {

            //code...
            $el = $this->contactModel;

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
        }
    }

}