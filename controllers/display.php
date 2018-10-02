<?php

interface IDisplayPlayers{
    function displayCLI($playerModels);
    function displayHTML($playerModels);
}

class Display implements IDisplayPlayers{
    /**
     * interates over array of data model's and displays them to CLI
     * @param $playerModels - array of player data models
     */
    function displayCLI($playerModels){
        echo "Current Players: \n";
        foreach ($playerModels as $player) {
            $playerInfo = json_decode($player->getPlayersData());
            echo "\tName: $playerInfo->name\n";
            echo "\tAge: $playerInfo->age\n";
            echo "\tSalary: $playerInfo->salary\n";
            echo "\tJob: $playerInfo->job\n\n";
        }
    }

    /**
     * interates over array of data model's and displays them as HTML
     * @param $playerModels - array of player data models
     */
    function displayHTML($playerModels){
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
                <?php foreach($playerModels as $player) { $playerInfo = json_decode($player->getPlayersData()); ?>
                    <li>
                        <div>
                            <span class="player-name">Name: <?= $playerInfo->name ?></span>
                            <span class="player-age">Age: <?= $playerInfo->age ?></span>
                            <span class="player-salary">Salary: <?= $playerInfo->salary ?></span>
                            <span class="player-job">Job: <?= $playerInfo->job ?></span>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </body>
        </html>
        <?php

    }
}

?>