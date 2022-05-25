<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Bridge\News as NewsServices;
use App\Services\Bridge\Video as VideoServices;
use App\Services\Bridge\Doctor as DoctorServices;
use App\Services\Api\Response as ResponseService;

use Response;
use Validator;

class DoctorController extends Controller
{
    /**
     * init service
     * @return true
     **/
    protected $response;
    protected $newsManager;
    protected $videoManager;
    protected $doctorManager;

	public function __construct(
        ResponseService $response,
        VideoServices $videoManager,
        NewsServices $newsManager,
        DoctorServices $doctorManager) 
	{
        parent::__construct();
        $this->response = $response;
        $this->videoManager = $videoManager;
        $this->newsManager = $newsManager;
        $this->doctorManager = $doctorManager;

    }
    
    public function index(Request $request)
    {
        return view('front.pages.doctor');
    }
    
    public function data(Request $request)
    {
        $data['doctor'] = $this->doctorManager->getData($request->all());

        return $this->response->setResponse('success get data', 'true', $data);
    }
    
    public function article(Request $request)
    {
        $data['news'] = $this->newsManager->getHomeData(['doctor_article'=> '1']);
        return view('front.pages.news', $data);
    }
    
    public function video(Request $request)
    {
        $data['is_from_doctor_url'] = true;
        $data['video'] = $this->videoManager->getFrontData(['video_article'=> '1']);
        // dd($data);
        return view('front.pages.video',$data);
    }
}