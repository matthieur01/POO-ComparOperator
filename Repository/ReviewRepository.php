<?php
include_once(__DIR__ . "/../Classes/Review.php");
include_once(__DIR__ . "/../Mappers/ReviewMapper.php");
include_once(__DIR__ . "/../Config/Database.php");



class ReviewRepository{
    private PDO $db;
    private Review $review;
    private array $reviews = [];


    public function __construct(PDO $db, Review $review){
        $this->db = Database::getConnection();
        $this->review = new Review(0,'','',0);
    }


    public function getReviewsByTO(int $idTO): array {


        $revStmt = $this->db->prepare('SELECT * FROM review WHERE tour_operator_id = :tour_operator_id');
        $revStmt->execute(['tour_operator_id' => $idTO]);
        $revRow = $revStmt->fetchAll();

        if ($revRow) {
            foreach ($revRow as $row) {
                $this->reviews[] = ReviewMapper::hydrate($row);
            }

        }

        return $this->reviews;
    }

    public function canCommentForTO(string $name, int $idTO):Bool{
        $cancomment = false;

        return $cancomment;

    }

    public function addReview(string $name, string $message, int $idTO){
        $destStmt = $this->db->prepare('INSERT INTO review (author, message, tour_operator_id)
             VALUES (:author, :message, :tour_operator_id)'
             );
        $destStmt->execute([
            'author' => $name,
            'message'=> $message, 
            'tour_operator_id'=> $idTO]);
    }



}
