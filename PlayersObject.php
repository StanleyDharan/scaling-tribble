<?php

/*
    Development Exercise

      The following code is poorly designed and error prone. Refactor the objects below to follow a more SOLID design.
      Keep in mind the fundamentals of MVVM/MVC and Single-responsibility when refactoring.

      Further, the refactored code should be flexible enough to easily allow the addition of different display
        methods, as well as additional read and write methods.

      Feel free to add as many additional classes and interfaces as you see fit.

      Note: Please create a fork of the https://github.com/BrandonLegault/exercise repository and commit your changes
        to your fork. The goal here is not 100% correctness, but instead a glimpse into how you
        approach refactoring/redesigning bad code. Commit often to your fork.

*/


/*interface IReadWritePlayers {
    function readPlayers($source, $filename = null);
    function writePlayer($source, $player, $filename = null);
    function display($isCLI, $course, $filename = null);
}
*/

interface IGetPlayers{
    function getPlayerDataArray();
    function getPlayerDataJson();
    function getPlayerDataFromFile($filename);
}

interface IWritePlayers{
    function writePlayer($source, $player, $filename = null);
}

interface IDisplayPlayers{
    function displayCLI($source, $PlayerObj);
    function displayHTML($source, $PlayerObj);
}

/* 
* Contains multiple methods to getting player data from different types of sources
*/
class GetPlayerData implements IGetPlayers{

    public function __construct(){}
    /** 
    * get JSON player data
    * @return string json
    */
    public function getPlayerDataJson() {
        $json = '[{"name":"Jonas Valenciunas","age":26,"job":"Center","salary":"4.66m"},{"name":"Kyle Lowry","age":32,"job":"Point Guard","salary":"28.7m"},{"name":"Demar DeRozan","age":28,"job":"Shooting Guard","salary":"26.54m"},{"name":"Jakob Poeltl","age":22,"job":"Center","salary":"2.704m"}]';
        
        $playerData = json_decode($json);
        return $playerData;
    }

    /**
     * get player data as array
     * @return array \stdClass
     */
    public function getPlayerDataArray() {

        $playerData = [];

        $jonas = new \stdClass();
        $jonas->name = 'Jonas Valenciunas';
        $jonas->age = 26;
        $jonas->job = 'Center';
        $jonas->salary = '4.66m';
        $playerData[] = $jonas;

        $kyle = new \stdClass();
        $kyle->name = 'Kyle Lowry';
        $kyle->age = 32;
        $kyle->job = 'Point Guard';
        $kyle->salary = '28.7m';
        $playerData[] = $kyle;

        $demar = new \stdClass();
        $demar->name = 'Demar DeRozan';
        $demar->age = 28;
        $demar->job = 'Shooting Guard';
        $demar->salary = '26.54m';
        $playerData[] = $demar;

        $jakob = new \stdClass();
        $jakob->name = 'Jakob Poeltl';
        $jakob->age = 22;
        $jakob->job = 'Center';
        $jakob->salary = '2.704m';
        $playerData[] = $jakob;

        return $playerData;
    }

    public function getPlayerDataFromFile($filename) {
        $playerData = file_get_contents($filename);

        return $playerData;
    }
}

class Display implements IDisplayPlayers{
    public function __construct(){}

    public function displayCLI($source, $PlayerObj){
        $players = null;

        switch ($source) {
            case 'array':
                $players = $PlayerObj->getPlayerArray();
                break;
            case 'json':
                $players = $PlayerObj->getPlayerJSON();
            case 'file':
                $players = $PlayerObj->getPlayerJSON();
        }

        echo "Current Players: \n";
        foreach ($players as $player) {

            echo "\tName: $player->name\n";
            echo "\tAge: $player->age\n";
            echo "\tSalary: $player->salary\n";
            echo "\tJob: $player->job\n\n";
        }
    }
    public function displayHTML($source, $PlayerObj) {
        $players = null;

        switch ($source) {
            case 'array':
                $players = $PlayerObj->getPlayerArray();
                break;
            case 'json':
                $players = $PlayerObj->getPlayerJSON();
            case 'file':
                $players = $PlayerObj->getPlayerJSON();
        }
        
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

class PlayersObject{

    private $playersArray;
    private $playerJsonString;
    private $playerData;

    public function __construct() {
        //We're only using this if we're storing players as an array.
        $this->playersArray = [];

        //We'll only use this one if we're storing players as a JSON string
        $this->playerJsonString = null;

        //Instantiate GetPlayerData
        $this->playerData = new GetPlayerData();
    }

    public function getPlayerJSON() {
        return $this->playerJsonString;
    }

    public function getPlayerArray() {
        return $this->playersArray;
    }

    public function loadData($source, $filename = null) {

        switch ($source) {
            case 'array':
                $this->playersArray = $this->playerData->getPlayerDataArray();
                break;
            case 'json':
                $this->playerJsonString = $this->playerData->getPlayerDataJson();
                break;
            case 'file':
                $this->playerJsonString = $this->playerData->getPlayerDataFromFile($filename);
                break;
        }
    }

}

$playersObject = new PlayersObject();
$displayPlayers = new Display();
$playersObject->loadData('array');
$displayPlayers->displayCLI('array', $playersObject);

?>