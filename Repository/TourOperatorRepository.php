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


    function getOneTOById(int $id): TourOperator{

        $toStmt = $this->db->prepare('SELECT * FROM tour_operator WHERE id = :id');
        $toStmt->execute( [ 'id' => $id ] );
        $totRow = $toStmt->fetch();

        if ($totRow) {

            $this->tourOperator = TourOperatorMapper::hydrate($totRow);
        
        }

        return $this->tourOperator;

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

    function suppressTourOperator(int $id){
        $destStmt = $this->db->prepare('DELETE FROM tour_operator WHERE id = :id');
        $destStmt->execute(['id' => $id]);
    }

    function editTourOperator(int $id, string $name, string $link, bool $isPremium){
        $destStmt = $this->db->prepare('UPDATE  tour_operator 
                                                SET name = :name,
                                                    link = :link,
                                                    is_premium = :isPremium
                                                 WHERE id = :id'
             );
        $destStmt->execute(['id' =>$id, 'name' => $name, 'link' => $link, 'isPremium'=>  $isPremium]);
    }

}