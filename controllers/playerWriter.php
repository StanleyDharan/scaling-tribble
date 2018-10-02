<?php

interface IWritePlayers{
    function writeDataToModel(&$ModelsList, $playersData);
}

/**
 * creates new data models from provided player data
 */
class PlayerWriter implements IWritePlayers{
    /**
     * takes stdClass objects and creates player data models
     * @param &$ModelsList - reference to a array of player data models
     * @param $playersData - array of stdClass objects containing player data.
     */
    public function writeDataToModel(&$ModelsList, $playersData){
        foreach($playersData as $player){
            $playerModel = new PlayersModel($player->name, $player->age, $player->job, $player->salary);

            array_push($ModelsList, $playerModel);
        }
    }
}
?>