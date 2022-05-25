<?php

namespace App\Traits;
use Route;

trait TagRelated
{
    

    /** 
     * store data
     * @param $data
     * @return array
     */
	public function storeTagRelated($params, $key_id)
    {
        try {
            //code...

            $model = ucfirst($params['class']);
            $class = "App\\Models\\$model";

            $object = $class::find($key_id);
            
            // if($object)
            // {
            if($object->tags()->first())
            {
                $object->tags()->delete();
            }

            $resultData = [];
            $tagData = explode(',', $params['tag_id']);

            foreach($tagData as $key=> $val) {
                $resultData[$key] = [
                    'tag_id' => isset($val) ? $val : '',
                    'key_id' => $key_id,
                    'key_type' => $class,
                ];
            }
            
            if($object->tags()->insert($resultData))
                return true;

            return false;
            // }

            // return false;
            
        } catch (\Exception $e) {
            return false;
            $this->message = $e->getMessage();
        }
    }
}