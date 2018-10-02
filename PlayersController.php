<?php
require 'PlayerModel.php';
require 'playerReader.php';
require 'playerWriter.php';

interface IDisplayPlayers{
    function displayCLI(&$PlayerModel);
    function displayHTML(&$PlayerModel);
}

class Display{
    function displayCLI(&$PlayerModel){
        $players = $PlayerModel->getPlayersData();

        echo var_dump($players);

        echo "Current Players: \n";
        foreach ($players as $player) {

            echo "\tName: $player->name\n";
            echo "\tAge: $player->age\n";
            echo "\tSalary: $player->salary\n";
            echo "\tJob: $player->job\n\n";
        }
    }

    function displayHTML(&$PlayerModel){
        $players = $PlayerModel->getPlayersData();

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                li {
                    list-style-type: none;
                    margin-bottom: 1em;
                }
                span {
                    display: block;
                }
            </style>
        </head>
        <body>
        <div>
            <span class="title">Current Players</span>
            <ul>
                <?php foreach($players as $player) { ?>
                    <li>
                        <div>
                            <span class="player-name">Name: <?= $player->name ?></span>
                            <span class="player-age">Age: <?= $player->age ?></span>
                            <span class="player-salary">Salary: <?= $player->salary ?></span>
                            <span class="player-job">Job: <?= $player->job ?></span>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </body>
        </html>
        <?php

    }
}

class PlayerController{
    private $reader;
    private $writer;
    private $display;
    private $model;

    public function __construct($readObj, $writeObj, $displayObj){
        $this->reader = $readObj;
        $this->writer = $writeObj;
        $this->display = $displayObj;
    }

    //create model
    public function createModel($DataModelObj){
        $this->model = $DataModelObj;
    }

    //data retrieval
    public function addJsonData(){
        if(!isset($this->model)){
            throw new Exception("No model was created to modify!");
        }
        else{
            $data = $this->reader->ReadPlayerDataJson();

            $this->writer->writeDataToModel($this->model, $data);
        }
    }

    public function addArrayData(){
        if(!isset($this->model)){
            throw new Exception("No model was created to modify!");
        }
        else{
            $data = $this->reader->ReadPlayerDataArray();
            $this->writer->writeDataToModel($this->model, $data);
        }
    }

    public function addFileData($filename){
        if(!isset($this->model)){
            throw new Exception("No model was created to modify!");
        }
        else{
            $data = $this->reader->ReadPlayerDataFromFile($filename);
            $this->writer->writeDataToModel($this->model, $data);
        }
    }
    //display model
    public function displayPlayersCLI(){
        $this->display->displayCLI($this->model);
    }

    public function displayPlayersHTML(){
        $this->display->displayHTML($this->model);
    }
}

$controller = new PlayerController(new PlayerReader(), new PlayerWriter(), new Display());
$controller->createModel(new PlayersModel());
$controller->addFileData('playerdata.json');
$controller->displayPlayersCLI();
?>