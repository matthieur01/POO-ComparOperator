<?php

class Review {
    
    private int $id;
    private string $author;
    private string $message;
    private int $tourOperatorId;
    
    function __construct(int $id, string $author, string $message, int $tourOperatorId){
        $this->id = $id;
        $this->author = $author;
        $this->message = $message;
        $this->tourOperatorId = $tourOperatorId;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getAuthor(): string{
        return $this->author;
    }

    public function getMessage(): string{
        return $this->message;
    }

    public function gettourOperatorId(): int{
        return $this->tourOperatorId;
    }
}