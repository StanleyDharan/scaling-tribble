<?php

class PlayersModel{

    private $name;
    private $age;
    private $job;
    private $salary;

    public function __construct($pName, $pAge, $pJob, $pSalary) {
        $this->name = $pName;
        $this->age = $pAge;
        $this->job = $pJob;
        $this->salary = $pSalary;
    }

    /**
     * retrieve's data model's properties
     * @return JSON string of the player's info
     */
    public function getPlayersData(){
        $data = ['name' => $this->name, 'age' => $this->age, 'job' => $this->job, 'salary' => $this->salary];
        $json = json_encode($data);
        return $json;
    }
}

?>