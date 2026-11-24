<?php

include_once(__DIR__ . "/../Classes/Destination.php");

class DestinationMapper{

    static public function hydrate(array $data ) : Destination{
        $my_destination = new Destination((int) $data['id'],
         (string)$data['location'],
          (int)$data['price'],
           (int)$data['tourOperatorId']);
        
        return $my_destination;  
    }
}