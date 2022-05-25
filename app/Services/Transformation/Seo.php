<?php

namespace App\Services\Transformation;

use LaravelLocalization;
class Seo
{
	
    /**
     * get Data For Edit Main Banner Cms Translation
     * @param $data
     * @param $lastInsertId
     * @return array|void
     */
    public function getEditSeoCmsTransform($data)
    {

        return $this->setEditSeoCmsTransform($data);
    }


    public function getEditPagesCmsTransform($data)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setEditPagesCmsTransform($data);
    }



   
    /**
     * Set Edit Data For Main Banner Cms Translation
     * @param $data
     * @return array|void
     */
    protected function setEditSeoCmsTransform($data)
    {
        try {

            $dataTransform['id'] = isset($data['id']) ? $data['id'] : '';
            $dataTransform['key_id'] = isset($data['key_id']) ? $data['key_id'] : '';
            $dataTransform['translations'] = $this->getTranslationData(isset($data['translations']) ? $data['translations'] : []);

            return $dataTransform;

        } catch(\Exception $e) {
            dd($e->getMessage());
            return [];
        }
    }


    protected function setEditPagesCmsTransform($data)
    {
        try {

            if(empty($data))
                return array();
            $dataTransform['pages_id'] = isset($data['id']) ? $data['id'] : '';
            $dataTransform['id'] = isset($data['seo'][0]['id']) && count($data['seo']) ? $data['seo'][0]['id'] : '';
            $dataTransform['key_id'] = isset($data['id']) ? $data['id'] : '';
            $dataTransform['translations'] = $this->getTranslationData(count($data['seo']) ? $data['seo'][0]['translations']: []);

            return $dataTransform;

        } catch(\Exception $e) {
            dd($e->getMessage());
            return [];
        }
    }


    public function getSaveSeoCmsTransform($data, $lastId, $isEdit)
    {
        if(!is_array($data) || empty($data))
            return array();

        return $this->setSaveSeoCmsTransform($data, $lastId, $isEdit);
    }


    protected function setSaveSeoCmsTransform($data, $lastId, $isEdit)
    {
        try {
            $supportedLanguage = LaravelLocalization::getSupportedLanguagesKeys();

            $finalData = [];
            foreach ($supportedLanguage as $key => $value) {
                $finalData[] = [
                    "locale" => $value,
                    "meta_title" => isset($data['meta_title'][$value]) ? $data['meta_title'][$value] : '',
                    "meta_keyword" => isset($data['meta_keyword'][$value]) ? $data['meta_keyword'][$value] : '',
                    "meta_description" => isset($data['meta_description'][$value]) ? html_entity_decode(strip_tags(htmlspecialchars_decode(trim(($data['meta_description'][$value]))))) : '',
                    "seo_id" => $lastId,
                    
                ];
            }

            return $finalData;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return [];
        }
    }
    


    protected function getTranslationData($data)
    {

        try {
            
            if(!is_array($data) || empty($data))
            {
                $supportedLanguage = LaravelLocalization::getSupportedLanguagesKeys();
                $returnValue = [];
                foreach ($supportedLanguage as $key => $value) {
                    $returnValue['meta_title'][$value] = '';
                    $returnValue['meta_keyword'][$value] = '';
                    $returnValue['meta_description'][$value] = '';
                }
                return $returnValue;
            }

            $returnValue = [];
            foreach ($data as $value) {
                
                $returnValue['meta_title'][$value['locale']] = $value['meta_title'];
                $returnValue['meta_keyword'][$value['locale']] = $value['meta_keyword'];
                $returnValue['meta_description'][$value['locale']] = $value['meta_description'];
            }
            
            return $returnValue;

        } catch(\Exception $e) {
            dd($e->getMessage());
            return [];
        }

    }

    public function frontDetail($params)
    {
        try {
            
            $locale = LaravelLocalization::getCurrentLocale();
            $dataTransform['meta_title'] = isset($params['translations']['meta_title'][$locale]) ? $params['translations']['meta_title'][$locale] : '';
            $dataTransform['meta_keyword'] = isset($params['translations']['meta_keyword'][$locale]) ? $params['translations']['meta_keyword'][$locale] : '';
            $dataTransform['meta_description'] = isset($params['translations']['meta_description'][$locale]) ? $params['translations']['meta_description'][$locale] : '';
            //code...
            return $dataTransform;
            
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }

}
