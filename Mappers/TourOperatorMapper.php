<?php

include_once(__DIR__ . "/../Classes/TourOperator.php");

class TourOperatorMapper{

    public function hydrate(array $data ) : TourOperator{
        $my_TO = new TourOperator((int) $data['id'], (string)$data['name'], (string)$data['link'], (int)$data['gradeCount'], (int)$data['gradeTotal'], (bool) $data['isPremium']);
        
        return $my_TO;  
    }
}