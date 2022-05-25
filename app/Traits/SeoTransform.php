<?php

namespace App\Traits;

trait SeoTransform
{
    public function getSeoTranslationData($data)
    {
        try {

            if(!is_array($data) || empty($data))
                return array();

            $returnValue = [];
            foreach ($data[0]['translations'] as $value) {
                $returnValue['title'][$value['locale']] = $value['meta_title'];
                $returnValue['keyword'][$value['locale']] = $value['meta_keyword'];
                $returnValue['description'][$value['locale']] = $value['meta_description'];
            }
            return $returnValue;

        } catch(\Exception $e) {
            return [];
        }

    }
}