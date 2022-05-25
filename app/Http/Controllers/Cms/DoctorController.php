<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\Category as CategoryServices;
use App\Services\Bridge\Doctor as DoctorServices;
use App\Services\Api\Response as ResponseService;
use JavaScript;
use Validator;

class DoctorController extends Controller
{
    /**
     * init service
     * @return true
     **/
    protected $response;
    protected $doctorManager;
    protected $categoryManager;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        DoctorServices $doctorManager, 
        CategoryServices $categoryManager,
        ResponseService $response)
    {
        $this->response = $response;
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

        $blade = 'cms.pages.doctor.index';

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
            
        $data['category'] = $this->categoryManager->getData([]);
        $data['doctor'] = $this->doctorManager->getDataCms($request->all());
        return $this->response->setResponse('Success get data', true, $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($doctorId)
    {
        return $this->doctorManager->editDataCms($doctorId);
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
            
            return $this->doctorManager->storeDataCms($request->except(['_token']));
        }
    }

    protected function validationStore($request = array())
    {
        $rules = [

            'description.id' => 'required',
            'fullname' => 'required',
            'location' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'category_id' => 'required',
            'foto' => 'required|dimensions:width='.DOCTOR_IMAGE_WIDTH.',height='.DOCTOR_IMAGE_HEIGHT.'|max:'. MAX_IMAGES_SIZE .'|mimes:jpeg,jpg,png',
        ];

        if(isset($request['old_foto']) && !empty($request['old_foto'])) 
            unset($rules['foto']);

        return $rules;

    }
}
