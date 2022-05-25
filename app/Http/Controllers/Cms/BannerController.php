<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Banner as BannerServices;
use App\Services\Api\Response as ResponseService;
use JavaScript;
use Validator;

class BannerController extends Controller
{
    /**
     * init service
     * @return true
     **/
    protected $response;
    protected $bannerManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BannerServices $bannerManager, 
        ResponseService $response)
    {
        $this->response = $response;
        $this->bannerManager = $bannerManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $blade = 'cms.pages.banner.index';

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
        $data['banner'] = $this->bannerManager->getDataCms($request->all());
        return $this->response->setResponse('Success get data', true, $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($bannerId)
    {
        return $this->bannerManager->editDataCms($bannerId);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(Request $request)
    {
        return $this->bannerManager->deleteDataCms($request->except(['_token']));
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
            return $this->bannerManager->storeDataCms($request->except(['_token']));
        }
    }

    protected function validationStore($request = array())
    {
        $rules = [
            
            'image' => 'required|dimensions:width='.HOME_BANNER_IMAGE_WIDTH.',height='.HOME_BANNER_IMAGE_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
            'title.id' => 'required'
        ];

        if(isset($request['old_image']) && !empty($request['old_image'])) 
            unset($rules['image']);

        return $rules;

    }
}
