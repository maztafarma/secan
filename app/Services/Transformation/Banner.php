<?php

namespace App\Services\Transformation;
use LaravelLocalization;
use Carbon\Carbon;

class Banner
{
    public function getListDataCms ($params)
    {
        return array_map(function($params) {

            return [
                'id' => isset($params['id']) ? $params['id'] : '',
                'image' => isset($params['image']) ? $params['image'] : '',
                'image_url' => isset($params['image']) ? asset(BANNER_DIR.$params['image']) : '',
                'title' => isset($params['translation']['title']) ? $params['translation']['title'] : ''
            ];

        }, $params);
    }

    public function getSingleDataCms ($params)
    {
        return [
            'id' => isset($params['id']) ? $params['id'] : '',
            'image' => isset($params['image']) ? $params['image'] : '',
            'image_url' => isset($params['image']) ? asset(BANNER_DIR.$params['image']) : '',
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