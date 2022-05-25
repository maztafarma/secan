<?php

namespace App\Traits;
use Route;

trait Meta 
{

    protected function generate($params = []) {

        try {

            //code...
            
            if (!empty($params['id']) && !empty($params['type'])) {
                return $this->seoManager->getEdit($params);
            }
            elseif (isset($params['id']) && !empty($params['route'])) {
                if ($page = $this->pageModel->where('id', $params['id'])->first()) {
                    $params = [
                        'id' => $page->id,
                        'type' => 'Pages'
                    ];
                    return $this->seoManager->getEdit($params);
                }
            }
            elseif (!empty($params['route'])) {
                if ($page = $this->pageModel->where('route', $params['route'])->first()) {
                    $params = [
                        'id' => $page->id,
                        'type' => 'Pages'
                    ];
                    return $this->seoManager->getEdit($params);
                }
            }
    
            return null;

        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
		
	}

	public function detail($params) {
		try {
			return $this->seoFrontTransform->frontDetail($this->generate($params));
		}
		catch (\Exception $e) {
            dd($th->getMessage());
            return abort(500);
		}
	}

    public function generate_meta()
    {
        try {
            
            //code...
            
            $stored_page = ['frontHome', 'frontSearch', 'frontAbout', 'frontNews', 'frontVideo', 'frontDoctor', 'frontSearch'];
            $route_name = Route::currentRouteName();
            
            if (in_array($route_name, $stored_page)){
                $params = [
                    'route' => $route_name
                ];

                return $this->detail($params);
            }
            
            $route = Route::getCurrentRoute();
            $slug = $id = $type = null;
            
            if ($route && $parameters = $route->parameters) {
                $slug = is_array($parameters) && isset($parameters['slug']) ? $parameters['slug'] : null;
               
                if (is_null($slug) && !empty($parameters['id'])) {
                    $slug = $parameters['id'];
                }
            }

            if ($route_name == 'frontNewsDetail') {
                
                $params = [
                    'slug' => $slug
                ];
                
                $blog = $this->newsManager->getHomeDetail($params);

                $id = $blog['id'];
                $type = 'News';
            }
            else if ($route_name == 'frontVideoDetail') {
                
                $params = [
                    'slug' => $slug
                ];
                
                $video = $this->videoManager->getFrontDetail($params);

                $id = $video['id'];
                $type = 'Video';
            }
            else if($route_name == 'frontNewsCategory') {

                if($slug == 'kesehatan') {
                    $params = [
                        'route' => $route_name,
                        'id' => '6'
                    ];
                }
                else if ($slug == 'kecantikan') {
                    $params = [
                        'route' => $route_name,
                        'id' => '5'
                    ];
                }

                return $this->detail($params);
                
            }

            else if($route_name == 'frontVideoCategory') {

                if($slug == 'kesehatan') {
                    $params = [
                        'route' => $route_name,
                        'id' => '9'
                    ];
                }
                else if ($slug == 'kecantikan') {
                    $params = [
                        'route' => $route_name,
                        'id' => '8'
                    ];
                }

                return $this->detail($params);
                
            }
            
            return $this->detail([
                'id' => $id,
                'type' => $type
            ]);
            
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
}