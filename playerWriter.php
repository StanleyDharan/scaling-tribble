<?php

interface IWritePlayers{
    function writeDataToModel(&$PlayerModel, $data);
}

class PlayerWriter implements IWritePlayers{
    
    public function writeDataToModel(&$PlayerModel, $data){
        $PlayerModel->setPlayersData($data);
    }
}
?>