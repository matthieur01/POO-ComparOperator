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
        $this->destination = new Destination(0,'',0,0);
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


    function getAllDestination(): array{

        $empStmt = $this->db->prepare('SELECT * FROM destination');
        $empStmt->execute();
        $empRow = $empStmt->fetch();

        if ($empRow) {
            foreach ($empRow as $row) {
                $this->destinations[] = DestinationMapper::hydrate($row);
            }

        }

        return $this->destinations;

    }




}
