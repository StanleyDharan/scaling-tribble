<?php
require 'PlayerModel.php';
require 'playerReader.php';
require 'playerWriter.php';
require 'display.php';

/**
 * Controller for all player data
 */
class PlayerController{
    private $reader;
    private $writer;
    private $display;
    private $playerModels = [];

    /**
     * @param $readObj - A new instance of the player read class
     * @param $writeObj - A new instance of the player write class
     * @param $displayObj - A new instance of the display class
     */
    public function __construct($readObj, $writeObj, $displayObj){
        $this->reader = $readObj;
        $this->writer = $writeObj;
        $this->display = $displayObj;
    }

    /**
     * wrapper function to read and create player data models from a JSON string.
     */
    public function addJsonData(){
        $playersData = $this->reader->ReadPlayerDataJson();

        $this->writer->writeDataToModel($this->playerModels, $playersData);
    }

    /**
     * wrapper function to read and create player data models from an Array.
     */
    public function addArrayData(){
        $playersData = $this->reader->ReadPlayerDataArray();

        $this->writer->writeDataToModel($this->playerModels, $playersData);
    }

    /**
     * wrapper function to read data from the file provided in param and then creates player models.
     * @param $filename - name of file to be read.
     */
    public function addFileData($filename){
        $playersData = $this->reader->ReadPlayerDataFromFile($filename);

        $this->writer->writeDataToModel($this->playerModels, $playersData);
    }
    
    /**
     * wrapper to display the player models in CLI
     */
    public function displayPlayersCLI(){
        $this->display->displayCLI($this->playerModels);
    }

    /**
     * wrapper to display player models as HTML
     */
    public function displayPlayersHTML(){
        $this->display->displayHTML($this->playerModels);
    }
}

$controller = new PlayerController(new PlayerReader(), new PlayerWriter(), new Display());
$controller->addJsonData('playerdata.json');
$controller->displayPlayersCLI();
?>