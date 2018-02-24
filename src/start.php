<?php
namespace src;

/** auto load */
spl_autoload_register(function ($target_name) {
    require_once __DIR__ . "/". str_replace("\\","/",$target_name) . ".php";
});

use osmiumDB\localStorage\JSON;
use switchboard\SwitchBoardServer;


$server = new SwitchBoardServer();
$server->start('127.0.0.1');





