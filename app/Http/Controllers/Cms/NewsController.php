<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\News as NewsServices;
use App\Services\Bridge\Doctor as DoctorServices;
use App\Services\Bridge\Category as CategoryServices;
use App\Services\Api\Response as ResponseService;
use JavaScript;
use Validator;

class NewsController extends Controller
{
    /**
     * init service
     * @return true
     **/
    protected $response;
    protected $newsManager;
    protected $doctorManager;
    protected $categoryManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        NewsServices $newsManager, 
        DoctorServices $doctorManager,
        CategoryServices $categoryManager,
        ResponseService $response)
    {
        $this->response = $response;
        $this->newsManager = $newsManager;
        $this->doctorManager = $doctorManager;
        $this->categoryManager = $categoryManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $blade = 'cms.pages.news.index';

        if(view()->exists($blade)) {

            return view($blade);

        }
        return abort(404);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function data(Request $request)
    {
        $data['news'] = $this->newsManager->getDataCms($request->all());
        $data['doctor'] = $this->doctorManager->getData([]);
        $data['category'] = $this->categoryManager->getData([]);
        return $this->response->setResponse('Success get data', true, $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($bannerId)
    {
        return $this->newsManager->editDataCms($bannerId);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(Request $request)
    {
        return $this->newsManager->deleteDataCms($request->except(['_token']));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $this->newsManager->storeDataCms($request->except(['_token']));
        }
    }

    protected function validationStore($request = array())
    {
        
        $rules = [
            'category_id' => 'required',
            'thumbnail' => 'required|dimensions:width='.THUMBNAIL_NEWS_IMAGE_WIDTH.',height='.THUMBNAIL_NEWS_IMAGE_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'home_thumbnail' => 'required|dimensions:width='.HOME_THUMBNAIL_NEWS_IMAGE_WIDTH.',height='.HOME_THUMBNAIL_NEWS_IMAGE_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'image' => 'required|dimensions:width='.NEWS_DETAIL_IMAGE_WIDTH.',height='.NEWS_DETAIL_IMAGE_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'title.id' => 'required',
            'content.id' => 'required',
            'seo.meta_title.id' => 'required',
            'seo.meta_keyword.id' => 'required',
            'seo.meta_description.id' => 'required',
        ];

        if(isset($request['old_thumbnail']) && !empty($request['old_thumbnail'])) 
            unset($rules['thumbnail']);

        if(isset($request['old_home_thumbnail']) && !empty($request['old_home_thumbnail'])) 
            unset($rules['home_thumbnail']);

        if(isset($request['old_image']) && !empty($request['old_image'])) 
            unset($rules['image']);

        return $rules;

    }
}
