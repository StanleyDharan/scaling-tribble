<?php
require 'controllers/PlayersController.php';

/**
 * Entry point for program
 */

$controller = new PlayerController(new PlayerReader(), new PlayerWriter(), new Display());
$controller->addJsonData();
$controller->addArrayData();
$controller->addFileData('playerdata.json');
$controller->displayPlayersCLI();
?>