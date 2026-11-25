<?php

include_once(__DIR__ . "/../Classes/Destination.php");

class DestinationMapper{

    static public function hydrate(array $data ) : Destination{
        $my_destination = new Destination((int) $data['id'],
         (string)$data['location'],
          (int)$data['price'],
           (int)$data['tour_operator_id'],
           (int)$data['id_dest_base']);
        
        return $my_destination;  
    }
}