<?php

interface IReadPlayers{
    function ReadPlayerDataArray();
    function ReadPlayerDataJson();
    function ReadPlayerDataFromFile($filename);
}


class PlayerReader implements IReadPlayers{
    
    public function ReadPlayerDataJson(){
        $json = '[{"name":"Jonas Valenciunas","age":26,"job":"Center","salary":"4.66m"},{"name":"Kyle Lowry","age":32,"job":"Point Guard","salary":"28.7m"},{"name":"Demar DeRozan","age":28,"job":"Shooting Guard","salary":"26.54m"},{"name":"Jakob Poeltl","age":22,"job":"Center","salary":"2.704m"}]';
        
        $playerData = json_decode($json);
        return $playerData;
    }

    public function ReadPlayerDataArray(){
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

    public function ReadPlayerDataFromFile($filename){
        $json = file_get_contents($filename);
        
        $playerData = json_decode($json);
        return $playerData;
        
    }
}

?>