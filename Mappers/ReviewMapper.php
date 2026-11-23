<?php

include_once(__DIR__ . "/../Classes/Review.php");

class ReviewMapper{

    public function hydrate(array $data ) : Review{
        $my_review = new Review((int) $data['id'],
         (string)$data['author'],
          (string)$data['message'],
           (int)$data['tourOperatorId']);
        
        return $my_review;  
    }
}