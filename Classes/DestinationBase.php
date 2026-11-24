<?php 

class DestinationBase{
    // TODO  - a faire
    private int $id;
    private string $location;


    public function __construct(int $id, string $location)
    {
        $this->id = $id;
        $this->location = $location;


    }

    public function getId(): int{
        return $this->id;
    }

    public function getLocation(): string{
        return $this->location;
    }


}