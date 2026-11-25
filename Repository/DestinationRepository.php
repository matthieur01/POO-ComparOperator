<?php
include_once(__DIR__ . "/../Classes/Destination.php");
include_once(__DIR__ . "/../Mappers/DestinationMapper.php");
include_once(__DIR__ . "/../Config/Database.php");



class DestinationRepository{


    private PDO $db;
    private Destination $destination;
    private array $destinations = [];

    public function __construct(){
        $this->db = Database::getConnection();
        $this->destination = new Destination(0,'',0,0,0);
    }



    function getOneDestination(int $id): Destination{

        $empStmt = $this->db->prepare('SELECT * FROM destination WHERE id = :id');
        $empStmt->execute(['id' => $id]);
        $empRow = $empStmt->fetch();

        if ($empRow) {
            $this->destination = DestinationMapper::hydrate($empRow);
        }

        return $this->destination;

    }


    function getAllDestinationByTO(int $idTO): array{

        $destStmt = $this->db->prepare('SELECT * FROM destination WHERE tour_operator_id = :id');
        $destStmt->execute(['id'=> $idTO]);
        $destRow = $destStmt->fetchAll();

        if ($destRow) {
            foreach ($destRow as $row) {
                $this->destinations[] = DestinationMapper::hydrate($row);
            }

        }

        return $this->destinations;

    }

   function createDestination(string $location, int $idTO, int $idDest, int $cost){


        $destStmt = $this->db->prepare('INSERT INTO destination (location, price, tour_operator_id, id_dest_base)
             VALUES (:location, :price, :tour_operator_id, :id_dest_base)'
             );
        $destStmt->execute([
            'location' => $location,
            'price'=> (int) $cost, 
            'tour_operator_id'=> $idTO, 
            'id_dest_base'=> $idDest]);
    }

    function suppressDest(int $id){
        $destStmt = $this->db->prepare('DELETE FROM destination WHERE id = :id');
        $destStmt->execute(['id' => $id]);
    }

    function editDestination(int $id, int $cost){
        $destStmt = $this->db->prepare('UPDATE  destination 
                                                SET price = :price
                                                 WHERE id = :id'
             );
        $destStmt->execute(['id' =>$id, 'price' => $cost]);
    }


}
