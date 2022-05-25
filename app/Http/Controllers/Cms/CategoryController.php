<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Category as CategoryServices;
use App\Services\Api\Response as ResponseService;
use JavaScript;
use Validator;

class CategoryController extends Controller
{
    /**
     * init service
     * @return true
     **/
    protected $response;
    protected $categoryManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CategoryServices $categoryManager, 
        ResponseService $response)
    {
        $this->response = $response;
        $this->categoryManager = $categoryManager;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $blade = 'cms.pages.category.index';

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
            
        $data['category'] = $this->categoryManager->getDataCms($request->all());
        return $this->response->setResponse('Success get data', true, $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($categoryId)
    {
        return $this->categoryManager->editDataCms($categoryId);
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
            return $this->categoryManager->storeDataCms($request->except(['_token']));
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
