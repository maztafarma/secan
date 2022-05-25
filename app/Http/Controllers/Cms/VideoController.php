<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Video as VideoServices;
use App\Services\Bridge\Doctor as DoctorServices;
use App\Services\Bridge\Category as CategoryServices;
use App\Services\Api\Response as ResponseService;
use JavaScript;
use Validator;

class VideoController extends Controller
{
    /**
     * init service
     * @return true
     **/
    protected $response;
    protected $videoManager;
    protected $doctorManager;
    protected $categoryManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        VideoServices $videoManager, 
        DoctorServices $doctorManager,
        CategoryServices $categoryManager,
        ResponseService $response)
    {
        $this->response = $response;
        $this->videoManager = $videoManager;
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

        $blade = 'cms.pages.video.index';

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
        $data['video'] = $this->videoManager->getDataCms($request->all());
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
        return $this->videoManager->editDataCms($bannerId);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(Request $request)
    {
        return $this->videoManager->deleteDataCms($request->except(['_token']));
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
            return $this->videoManager->storeDataCms($request->except(['_token']));
        }
    }

    protected function validationStore($request = array())
    {
        $rules = [
            'category_id' => 'required',
            'home_thumbnail' => 'required|dimensions:width='.HOME_THUMBNAIL_VIDEO_IMAGE_WIDTH.',height='.HOME_THUMBNAIL_VIDEO_IMAGE_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'thumbnail' => 'required|dimensions:width='.THUMBNAIL_VIDEO_IMAGE_WIDTH.',height='.THUMBNAIL_VIDEO_IMAGE_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'youtube_url' => 'required|url',
            'title.id' => 'required',
            'seo.meta_title.id' => 'required',
            'seo.meta_keyword.id' => 'required',
            'seo.meta_description.id' => 'required',
        ];

        if(isset($request['old_thumbnail']) && !empty($request['old_thumbnail'])) 
            unset($rules['thumbnail']);

        if(isset($request['old_home_thumbnail']) && !empty($request['old_home_thumbnail'])) 
            unset($rules['home_thumbnail']);

        return $rules;

    }
}
