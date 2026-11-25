<?php

include_once(__DIR__ . "/../Classes/TourOperator.php");

class TourOperatorMapper{

    static public function hydrate(array $data ) : TourOperator{
        $my_TO = new TourOperator((int) $data['id'], (string)$data['name'], (string)$data['link'], (int)$data['grade_count'], (int)$data['grade_total'], (bool) $data['is_premium']);
        
        return $my_TO;  
    }
}