<?php

interface IReadPlayers{
    function ReadPlayerDataArray($dataArray = null);
    function ReadPlayerDataJson($jsonString = null);
    function ReadPlayerDataFromFile($filename);
}

/**
 * Read's data from specified data type
 */
class PlayerReader implements IReadPlayers{
    /**
     * @return array of stdClass objects
     */
    public function ReadPlayerDataJson($jsonString = null){
        $json = null;
        if($jsonString){
            $json = $jsonString;
        }
        else{
            $json = '[{"name":"Jonas Valenciunas","age":26,"job":"Center","salary":"4.66m"},{"name":"Kyle Lowry","age":32,"job":"Point Guard","salary":"28.7m"},{"name":"Demar DeRozan","age":28,"job":"Shooting Guard","salary":"26.54m"},{"name":"Jakob Poeltl","age":22,"job":"Center","salary":"2.704m"}]';
        }
        $playerData = json_decode($json);
        return $playerData;
    }

    /**
     * @return array of stdClass objects
     */
    public function ReadPlayerDataArray($dataArray = null){
        $size = count($dataArray);
        if($size > 0){
            $type = gettype($dataArray[0]);
            if($type == 'object'){
                return $dataArray;
            }
        }
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

    /**
     * @param $filename - name of file to be parsed
     * @return array of stdClass objects
     */
    public function ReadPlayerDataFromFile($filename){
        $json = file_get_contents($filename);
        
        $playerData = json_decode($json);
        return $playerData;
        
    }
}

?>