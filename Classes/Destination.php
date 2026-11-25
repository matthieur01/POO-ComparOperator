<?php 

class Destination{

    private int $id;
    private string $location;
    private int $price;
    private int $tourOperatorId;
    private int $idDestBase;

    public function __construct(int $id, string $location, int $price, int $tourOperatorId, int $idDestBase)
    {
        $this->id = $id;
        $this->location = $location;
        $this->price = $price;
        $this->tourOperatorId = $tourOperatorId;
        $this->idDestBase = $idDestBase;

    }

    public function getId(): int{
        return $this->id;
    }

    public function getLocation(): string{
        return $this->location;
    }

    public function getPrice(): int{
        return $this->price;
    }

    public function gettouroperatorId(): int{
        return $this->tourOperatorId;
    }
    public function getIdDestBase(): int{
        return $this->idDestBase;
    }

}