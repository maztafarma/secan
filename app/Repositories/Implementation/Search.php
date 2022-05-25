<?php

namespace App\Repositories\Implementation;

use App\Models\News as NewsModel;
use App\Models\Video as VideoModel;
use App\Models\Category as CategoryModel;
use App\Services\Api\Response as ResponseService;
use App\Repositories\Contracts\Search as SearchInterface;
use App\Services\Transformation\Search as SearchTransformation;
use Carbon\Carbon;
use DB;
use LaravelLocalization;

class Search implements SearchInterface
{
    protected $newsModel;
    protected $videoModel;
    protected $categoryModel;
    protected $searchTransform;
    protected $message;
    protected $lastInsertId;
    protected $response;

    function __construct(
        NewsModel $newsModel,  
        VideoModel $videoModel, 
        CategoryModel $categoryModel,
        SearchTransformation $searchTransform,
        ResponseService $response)
    {

        $this->response = $response;
        $this->newsModel = $newsModel;
        $this->videoModel = $videoModel;
        $this->categoryModel = $categoryModel;
        $this->searchTransform = $searchTransform;
    }

    /** 
     * get data
     * @param $data
     * @return array
     */

    public function getResult($params)
    {
        try {

            return $this->searchTransform->getResultData($this->searchManager($params));

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    protected function searchManager($params = array(), $orderType = 'desc')
    {
        try {
            //code...

            $result = [];
            $resultData = [];

            $resultNews = $this->newsModel->with(['translation', 'translations', 'category.translation']);
            $resultVideo = $this->videoModel->with(['translation', 'translations', 'category.translation']);

            $resultNews->whereHas('translations', function($q) use($params) {

                $q->where(function ($query) use ($params) {
                    $query->where('title','like','%' . $params['q'] . '%');
                })->orWhere(function($query) use ($params) {
                    $query->where('content','like','%' . $params['q'] . '%');   
                });
            });

            $resultVideo->whereHas('translations', function($q) use($params) {

                $q->where(function ($query) use ($params) {
                    $query->where('title','like','%' . $params['q'] . '%');
                });
            });


            $resultData['news'] = $resultNews->get()->toArray();
            $resultData['video'] = $resultVideo->get()->toArray();

            return $resultData;


        } catch (\Exception $e) {
            //throw $th;
            dd($e->getMessage());
        }
    }

}