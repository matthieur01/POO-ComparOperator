<?php

include_once(__DIR__ . "/../Classes/Destination.php");

class DestinationBaseMapper{

    static public function hydrate(array $data ) : DestinationBase{
        $my_destination = new DestinationBase((int) $data['id'],
         (string)$data['location']);
        
        return $my_destination;  
    }
}