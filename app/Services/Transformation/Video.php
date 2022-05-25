<?php

namespace App\Services\Transformation;
use LaravelLocalization;
use Carbon\Carbon;

class Video
{
    public function getFrontData ($params)
    {
        return array_map(function($params) {

            return [

                'id' => isset($params['id']) ? $params['id'] : '',
                'slug' => isset($params['slug']) ? $params['slug'] : '',
                'thumbnail_url' => isset($params['thumbnail']) ? asset(VIDEO_DIR.$params['thumbnail']) : '',
                'home_thumbnail_url' => isset($params['home_thumbnail']) ? asset(VIDEO_DIR.$params['home_thumbnail']) : '',
                'youtube_url' => isset($params['youtube_url']) ? $params['youtube_url'] : '',
                'title' => isset($params['translation']['title']) ? $params['translation']['title'] : '',
                'category' => isset($params['category']['translation']['title']) ? $params['category']['translation']['title'] : '',
                'category_slug' => isset($params['category']['slug']) ? $params['category']['slug'] : '',
                'doctor_photo_url' => isset($params['doctor']['foto']) ? asset(DOCTOR_DIR.$params['doctor']['foto']) : '',
                'doctor_name' => isset($params['doctor']['fullname']) ? $params['doctor']['fullname'] : '',
            ];

        }, $params);
    }

    public function getFrontDetail ($params)
    {
        if(empty($params))
            return [];
            
        return [

            'id' => isset($params['id']) ? $params['id'] : '',
            'slug' => isset($params['slug']) ? $params['slug'] : '',
            'thumbnail_url' => isset($params['thumbnail']) ? asset(VIDEO_DIR.$params['thumbnail']) : '',
            'home_thumbnail_url' => isset($params['home_thumbnail']) ? asset(VIDEO_DIR.$params['home_thumbnail']) : '',
            'youtube_url' => isset($params['youtube_url']) ? $params['youtube_url'] : '',
            'publish_date' => isset($params['publish_date']) ? Carbon::parse($params['publish_date'])->format('d/m/Y') : '',
            'title' => isset($params['translation']['title']) ? $params['translation']['title'] : '',
            'category' => isset($params['category']['translation']['title']) ? $params['category']['translation']['title'] : '',
            'category_id' => isset($params['category_id']) ? $params['category_id'] : '',
            'doctor_id' => isset($params['doctor_id']) ? $params['doctor_id'] : '',
            'category_slug' => isset($params['category']['slug']) ? $params['category']['slug'] : '',
        ];
    }

    public function getDataCms ($params)
    {
        return array_map(function($params) {

            return [
                
                'id' => isset($params['id']) ? $params['id'] : '',
                'title' => isset($params['translation']['title']) ? $params['translation']['title'] : '',
                'home_thumbnail_url' => isset($params['home_thumbnail']) ? asset(VIDEO_DIR.$params['home_thumbnail']) : '',
                'category' => isset($params['category']['translation']['title']) ? $params['category']['translation']['title'] : '',
                'publish_date' => isset($params['publish_date']) ? Carbon::parse($params['publish_date'])->format('d M Y') : '',
            ];

        }, $params);
    }

    public function getSingleDataCms ($params)
    {
        return [
            'id' => isset($params['id']) ? $params['id'] : '',
            'youtube_url' => isset($params['youtube_url']) ? $params['youtube_url'] : '',
            'thumbnail' => isset($params['thumbnail']) ? $params['thumbnail'] : '',
            'thumbnail_url' => isset($params['thumbnail']) ? asset(VIDEO_DIR.$params['thumbnail']) : '',
            'home_thumbnail' => isset($params['home_thumbnail']) ? $params['home_thumbnail'] : '',
            'home_thumbnail_url' => isset($params['home_thumbnail']) ? asset(VIDEO_DIR.$params['home_thumbnail']) : '',
            'category_id' => isset($params['category_id']) ? $params['category_id'] : '',
            'doctor_id' => isset($params['doctor_id']) ? $params['doctor_id'] : '',
            'translations' => isset($params['translations']) ? $this->setDataTranslations($params['translations']) : [],
            'tags' => isset($params['tags']) && !empty($params['tags']) ? $this->setTagData($params['tags']) : []
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

    protected function setTagData($params)
    {
        return array_map(function($params) {

            return [
                'id' => isset($params['tag_id']) ? $params['tag_id'] : '',
                'title' => isset($params['tag']['translation']['title']) ? $params['tag']['translation']['title'] : ''
            ];
        },$params);
    }
}