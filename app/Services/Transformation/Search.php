<?php

namespace App\Services\Transformation;
use LaravelLocalization;
use Carbon\Carbon;

class Search
{
    public function getResultData($params)
    {
        $resultData = [];

        if(isset($params['news']) && !empty($params['news']))
            $resultData['news'] = $this->getNewsTransformData($params['news']);
        else
            $resultData['news'] = [];

        if(isset($params['video']) && !empty($params['video']))
            $resultData['video'] =$this->getVideoTransformData($params['video']);
        else
            $resultData['video'] = [];

        return $resultData;
    }

    protected function getNewsTransformData($news)
    {
        return array_map(function($news) {

            return [

                'slug' => isset($news['slug']) ? $news['slug'] : '',
                'publish_date' => isset($news['publish_date']) ? Carbon::parse($news['publish_date'])->format('d/m/Y') : '',
                'thumbnail_url' => isset($news['thumbnail']) ? asset(NEWS_DIR.$news['thumbnail']) : '',
                'title' => isset($news['translation']['title']) ? $news['translation']['title'] : '',
                'content' => isset($news['translation']['content']) ? str_limit($news['translation']['content'], 150) : '',
                'category' => isset($news['category']['translation']['title']) ? $news['category']['translation']['title'] : '',
            ];
        },$news);
    }

    protected function getVideoTransformData($video)
    {
        return array_map(function($video) {

            return [

                'slug' => isset($video['slug']) ? $video['slug'] : '',
                'thumbnail_url' => isset($video['thumbnail']) ? asset(VIDEO_DIR.$video['thumbnail']) : '',
                'title' => isset($video['translation']['title']) ? $video['translation']['title'] : '',
                'category' => isset($video['category']['translation']['title']) ? $video['category']['translation']['title'] : '',
            ];
        },$video);
    }
}