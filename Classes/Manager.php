<?php
//TODO    -   a faired 
class   Manager{
    
    private PDO $bdd;

    
    public function __construct(PDO $bdd)
    {
            $this->bdd = $bdd;
    }

}