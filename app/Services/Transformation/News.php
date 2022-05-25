<?php

namespace App\Services\Transformation;
use LaravelLocalization;
use Carbon\Carbon;

class News
{
    public function getHomeData ($params)
    {
        return array_map(function($params) {

            return [
                
                'slug' => isset($params['slug']) ? $params['slug'] : '',
                'publish_date' => isset($params['publish_date']) ? Carbon::parse($params['publish_date'])->format('d/m/Y') : '',
                'thumbnail_url' => isset($params['thumbnail']) ? asset(NEWS_DIR.$params['thumbnail']) : '',
                'home_thumbnail_url' => isset($params['home_thumbnail']) ? asset(NEWS_DIR.$params['home_thumbnail']) : '',
                'image_url' => isset($params['image']) ? asset(NEWS_DIR.$params['image']) : '',
                'title' => isset($params['translation']['title']) ? $params['translation']['title'] : '',
                'content' => isset($params['translation']['content']) ? html_entity_decode(strip_tags(htmlspecialchars_decode(trim((str_limit($params['translation']['content'], 200)))))) : '',
                'category' => isset($params['category']['translation']['title']) ? $params['category']['translation']['title'] : '',
                'category_slug' => isset($params['category']['slug']) ? $params['category']['slug'] : '',
            ];

        }, $params);
    }

    public function getHomeDetail ($params)
    {
        if(empty($params))
            return [];

        return [

            'id' => isset($params['id']) ? $params['id'] : '',
            'slug' => isset($params['slug']) ? $params['slug'] : '',
            'publish_date' => isset($params['publish_date']) ? Carbon::parse($params['publish_date'])->format('d/m/Y') : '',
            'home_thumbnail_url' => isset($params['home_thumbnail']) ? asset(NEWS_DIR.$params['home_thumbnail']) : '',
            'image_url' => isset($params['image']) ? asset(NEWS_DIR.$params['image']) : '',
            'title' => isset($params['translation']['title']) ? $params['translation']['title'] : '',
            'content' => isset($params['translation']['content']) ? $params['translation']['content'] : '',
            'category' => isset($params['category']['translation']['title']) ? $params['category']['translation']['title'] : '',
            'category_id' => isset($params['category']['id']) ? $params['category']['id'] : '',
            'category_slug' => isset($params['category']['slug']) ? $params['category']['slug'] : '',
            'publish_by' => isset($params['publish_by']) ? $params['publish_by'] : '',
            'doctor_name' => isset($params['doctor']['fullname']) ? $params['doctor']['fullname'] : '',
            'photo' => isset($params['admin']['photo']) && !empty($params['admin']['photo']) ? asset(USER_DIR.$params['admin']['photo']) : null,
        ];
    }

    public function getDataCms ($params)
    {
        return array_map(function($params) {

            return [
                
                'id' => isset($params['id']) ? $params['id'] : '',
                'home_thumbnail_url' => isset($params['home_thumbnail']) ? asset(NEWS_DIR.$params['home_thumbnail']) : '',
                'publish_date' => isset($params['publish_date']) ? $params['publish_date'] : '',
                'title' => isset($params['translation']['title']) ? $params['translation']['title'] : '',
                'category' => isset($params['category']['translation']['title']) ? $params['category']['translation']['title'] : '',
            ];

        }, $params);
    }
    
    public function getSingleDataCms ($params)
    {
        return [
            'id' => isset($params['id']) ? $params['id'] : '',
            'image' => isset($params['image']) ? $params['image'] : '',
            'thumbnail' => isset($params['thumbnail']) ? $params['thumbnail'] : '',
            'thumbnail_url' => isset($params['thumbnail']) ? asset(NEWS_DIR.$params['thumbnail']) : '',
            'home_thumbnail' => isset($params['home_thumbnail']) ? $params['home_thumbnail'] : '',
            'home_thumbnail_url' => isset($params['home_thumbnail']) ? asset(NEWS_DIR.$params['home_thumbnail']) : '',
            'image_url' => isset($params['image']) ? asset(NEWS_DIR.$params['image']) : '',
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
            $return['content'][$tran['locale']] = $tran['content'];
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

    public function getCommentData($params)
    {
        return array_map(function($params) {
            return [
                'fullname' => isset($params['fullname']) ? $params['fullname'] : '',
                'phone_number' => isset($params['phone_number']) ? $params['phone_number'] : '',
                'website_url' => isset($params['website_url']) ? $params['website_url'] : '',
                'comment' => isset($params['comment']) ? $params['comment'] : '',
                'created_at' => isset($params['created_at']) ? Carbon::parse($params['created_at'])->format('d M Y H:i') : '',
            ];
        },$params);
    }
}