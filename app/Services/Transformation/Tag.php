<?php

namespace App\Services\Transformation;
use LaravelLocalization;
use Carbon\Carbon;

class Tag
{
    public function getFrontData ($params)
    {

        return array_map(function($params) {

            return [

                'slug' => isset($params['slug']) ? $params['slug'] : '',
                'title' => isset($params['translation']['title']) ? ucwords($params['translation']['title']) : '',
                'total' => isset($params['type']) ? count($params['type']) : 0
            ];

        }, $params);
    }

    public function getDataCms ($params)
    {
        return array_map(function($params) {

            return [
                
                'id' => isset($params['id']) ? $params['id'] : '',
                'title' => isset($params['translation']['title']) ? $params['translation']['title'] : ''
            ];

        }, $params);
    }

    public function getSingleDataCms ($params)
    {
        return [
            'id' => isset($params['id']) ? $params['id'] : '',
            'translations' => isset($params['translations']) ? $this->setDataTranslations($params['translations']) : []
        ];
    }

    /**
     * Set Data Translations
     * @param $params
     * @return array
     */
    protected function setDataTranslations($params)
    {
        $return = [];
        foreach ($params as $tran) {
            $return['title'][$tran['locale']] = $tran['title'];
        }
        return $return;
    }
}