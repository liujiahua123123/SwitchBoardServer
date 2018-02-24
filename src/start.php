<?php
namespace src;

/** auto load */
spl_autoload_register(function ($target_name) {
    require_once __DIR__ . "/". str_replace("\\","/",$target_name) . ".php";
});

use osmiumDB\localStorage\JSON;
use switchboard\SwitchBoardServer;

define("PROTOCOL_VERSION",1);
define("SERVER_VERSION",1);
define("SERVER_ROLE",1);
const CONFIG_FILE = "config.json";


//config部分
$config = [
    "port"=>9502,
    "switchboard-name"=>"switchboard",
    "key"=>generate_password()
];

$json = new JSON(__DIR__."/".CONFIG_FILE,$config);
//加载config
$config = $json->getAll();


echo "switchboard is about to start\nconfig info:\n";
var_dump($config);
flush();
sleep(1);
echo "\nprotocol version | ".PROTOCOL_VERSION;
echo "\nswitchboard role | ".SERVER_ROLE;
echo "\nplease check key in config.json\n";

$server = new SwitchBoardServer();
$server->start('127.0.0.1', $config["port"]);



function generate_password( $length = 8 ){
// 密码字符集，可任意添加需要的字符
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|’';
    $password = "";
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $password;
}

