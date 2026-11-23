<?php 

class Destination{
    // TODO  - a faire
    private int $id;
    private string $location;
    private int $price;
    private int $tourOperatorId;

    public function __construct(int $id, string $location, int $price, int $tourOperatorId)
    {
        $this->id = $id;
        $this->location = $location;
        $this->price = $price;
        $this->tourOperatorId = $tourOperatorId;

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

}