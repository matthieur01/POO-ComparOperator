<?php
include_once(__DIR__ . "/../Classes/DestinationBase.php");
include_once(__DIR__ . "/../Mappers/DestinationBaseMapper.php");
include_once(__DIR__ . "/../Config/Database.php");



class DestinationBaseRepository{


    private PDO $db;
    private DestinationBase $destinationBase;
    private array $destinationsBase = [];

    public function __construct(){
        $this->db = Database::getConnection();
        $this->destinationBase = new DestinationBase(0,'');
    }



    function getOneDestination(int $id): DestinationBase{

        $empStmt = $this->db->prepare('SELECT * FROM destination_base WHERE id = :id');
        $empStmt->execute(['id' => $id]);
        $empRow = $empStmt->fetch();

        if ($empRow) {
            $this->destinationBase = DestinationBaseMapper::hydrate($empRow);
        }

        return $this->destinationBase;

    }


    function getAllDestination(): array{

        $destStmt = $this->db->prepare('SELECT * FROM destination_base');
        $destStmt->execute();
        $destRow = $destStmt->fetchAll();

        if ($destRow) {
            foreach ($destRow as $row) {
                $this->destinationsBase[] = DestinationBaseMapper::hydrate($row);
            }

        }

        return $this->destinationsBase;

    }

    function createDestinationBase(string $location){
        $destStmt = $this->db->prepare('INSERT INTO destination_base (location)
             VALUES (:location)'
             );
        $destStmt->execute(['location' => $location]);
    }




}
