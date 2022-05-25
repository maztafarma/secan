<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Tag as TagServices;
use App\Services\Api\Response as ResponseService;
use JavaScript;
use Validator;

class TagController extends Controller
{
    /**
     * init service
     * @return true
     **/
    protected $response;
    protected $tagManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        TagServices $tagManager, 
        ResponseService $response)
    {
        $this->response = $response;
        $this->tagManager = $tagManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $blade = 'cms.pages.tag.index';

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
        if(isset($request['is_json']))
            return $this->tagManager->getDataCms($request->all());
            
        $data['tag'] = $this->tagManager->getDataCms($request->all());
        return $this->response->setResponse('Success get data', true, $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($tagId)
    {
        return $this->tagManager->editDataCms($tagId);
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
            return $this->tagManager->storeDataCms($request->except(['_token']));
        }
    }

    protected function validationStore($request = array())
    {
        $rules = [
            'title.id' => 'required',
        ];

        return $rules;

    }
}
