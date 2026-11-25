<?php

include_once(__DIR__ . "/../Classes/TourOperator.php");
include_once(__DIR__ . "/../Mappers/TourOperatorMapper.php");
include_once(__DIR__ . "/../Config/Database.php");

class TourOperatorRepository{
 

    private PDO $db;
    private TourOperator $tourOperator;
    private array $toursOperator = [];

    public function __construct(){
        $this->db = Database::getConnection();
        $this->tourOperator = new TourOperator(0,'','',0,0,false);

    }



    function getAllTO(): array{

        $toStmt = $this->db->prepare('SELECT * FROM tour_operator');
        $toStmt->execute();
        $totRow = $toStmt->fetchAll();

        if ($totRow) {
            foreach ($totRow as $row) {
                $this->toursOperator[] = TourOperatorMapper::hydrate($row);
            }

        }

        return $this->toursOperator;

    }

    function createTourOperator(string $name, string $link, bool $isPremium){
        $destStmt = $this->db->prepare('INSERT INTO tour_operator (name, link, grade_count, grade_total, is_premium)
             VALUES (:name, :link, :grade_c, :grade_t, :isPremium)'
             );
        $destStmt->execute([
            'name' => $name,
            'link'=> $link, 
            'grade_c'=> (int) 0, 
            'grade_t'=> (int) 0, 
            'isPremium'=> $isPremium]);
    }


}