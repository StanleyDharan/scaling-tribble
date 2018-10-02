<?php

class PlayersModel{

    private $playersData;
    private $name;
    private $age;
    private $job;
    private $salary;

    public function __construct() {}

    public function getPlayersData(){
        return $this->playersData;
    }

    public function setPlayersData($data){
        $this->playersData = $data;
    }
}

?>