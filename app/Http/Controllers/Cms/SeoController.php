<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Services\Bridge\Seo as SeoServices;
use App\Services\Api\Response as ResponseService;
use Illuminate\Http\Request;
use Validator;

class SeoController extends Controller
{
    protected $seo;
    protected $response;
    /**
     * MenuController
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function __construct(SeoServices $seo, ResponseService $response)
    {
        $this->seo = $seo;
        $this->response = $response;
    }

    public function index(Request $request)
    {

        $blade = 'cms.pages.seo.index';
        if(view()->exists($blade)) {
            return view($blade);
        }
    }

    public function data(Request $request)
    {
        $data = $this->seo->getData($request->except('_token'));
        return $this->response->setResponse( 'Success get data', true, $data);
    }

    public function edit($id, Request $request)
    {
        $data = $this->seo->getEditPages(['id' => $id, 'type'=> $request['type']]);
        return $this->response->setResponse( 'Success get data', true, $data);
    }


    /**
     * Store
     */
    public function store(Request $request)
    {

        $request['type_seo'] = "Pages";
        
        $validator = Validator::make($request->all(), $this->validateStore($request));

        if ($validator->fails()) {
            //TODO: case fail
            return $this->response->setResponseErrorFormValidation($validator->messages(), false);

        } else {
            //TODO: case pass
            return $data = $this->seo->getStore($request->except('_token'));
        }

    }


     /**
     * validator
     */
    protected function validateStore($request = array())
    {
        $rules = [

            'meta_title.id'          => 'required',
            'meta_keyword.id'        => 'required',
            'meta_description.id'    => 'required',
        ];

        return $rules;
    }


}
