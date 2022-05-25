<?php

namespace App\Services\Transformation;
use LaravelLocalization;
use Carbon\Carbon;

class Doctor
{
    public function getData ($params)
    {
        return array_map(function($params) {

            return [

                'id' => isset($params['id']) ? $params['id'] : '',
                'title' => isset($params['fullname']) ? $params['fullname'] : '',
                'fullname' => isset($params['fullname']) ? $params['fullname'] : '',
                'location' => isset($params['location']) ? $params['location'] : '',
                'longitude' => isset($params['longitude']) ? $params['longitude'] : '',
                'latitude' => isset($params['latitude']) ? $params['latitude'] : '',
                'address' => isset($params['address']) ? $params['address'] : '',
                'phone_number' => isset($params['phone_number']) ? $params['phone_number'] : '',
                'foto_url' => isset($params['foto']) ? asset(DOCTOR_DIR.$params['foto']) : '',
                'description' => isset($params['information']['description']) ? $params['information']['description'] : '',
                'total_artikel' => isset($params['artikel']) ? count($params['artikel']) : '',
                'category_slug' => isset($params['category']['slug']) ? $params['category']['slug'] : '',
                'category_name' => isset($params['category']['translation']['title']) ? $params['category']['translation']['title'] : '',
            ];

        }, $params);
    }

    public function getDataCms ($params)
    {
        return array_map(function($params) {

            return [
                
                'id' => isset($params['id']) ? $params['id'] : '',
                'fullname' => isset($params['fullname']) ? $params['fullname'] : '',
                'location' => isset($params['location']) ? $params['location'] : '',
                'foto_url' => isset($params['foto']) ? asset(DOCTOR_DIR.$params['foto']) : '',
                'category_name' => isset($params['category']['translation']['title']) ? $params['category']['translation']['title'] : '',
            ];

        }, $params);
    }

    public function getSingleDataCms ($params)
    {
        return [
            
            'id' => isset($params['id']) ? $params['id'] : '',
            'category_id' => isset($params['category_id']) ? $params['category_id'] : '',
            'fullname' => isset($params['fullname']) ? $params['fullname'] : '',
            'location' => isset($params['location']) ? $params['location'] : '',
            'longitude' => isset($params['longitude']) ? $params['longitude'] : '',
            'latitude' => isset($params['latitude']) ? $params['latitude'] : '',
            'address' => isset($params['address']) ? $params['address'] : '',
            'phone_number' => isset($params['phone_number']) ? $params['phone_number'] : '',
            'foto' => isset($params['foto']) ? $params['foto'] : '',
            'foto_url' => isset($params['foto']) ? asset(DOCTOR_DIR.$params['foto']) : '',
            'information' => isset($params['informations']) ? $this->setDataInformation($params['informations']) : []
        ];
    }

    /**
     * Set Data Information
     * @param $params
     * @return array
     */
    protected function setDataInformation($params)
    {
        $return = [];
        foreach ($params as $tran) {
            $return['description'][$tran['locale']] = $tran['description'];
        }
        return $return;
    }
}