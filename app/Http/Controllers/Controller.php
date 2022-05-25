<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Facades\App\Services\Bridge\Front as FrontService;

use View;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct() {
        $this->_init();
    }

    private function _init() {

        $this->set_view_global();
    }



    public function set_view_global() {

        $seo = FrontService::generate_meta();
// dd($seo);
        View::composer('front.partials.meta', function($view) use($seo) {
            $view->with('title', $seo['meta_title']);
            $view->with('keyword', $seo['meta_keyword']);
            $view->with('description', $seo['meta_description']);
        });
    }
}
