<?php
namespace switchboard;

use osmiumDB\LocalStorage\JSON;
use switchboard\utils\LogLevel;
use switchboard\utils\TextFormat;
use switchboard\utils\Utils;

class SwitchBoardServer extends TCPServer {
    const CONFIG_FILE = "config.json";
    public $config;

    private function defineInfo(){
        define("PROTOCOL_VERSION",1);
        define("SERVER_VERSION",1);
        define("SERVER_ROLE",1);//config部分
    }

    private function configLoader(){
        $config = [
            "config-version"=>1,
            "port"=>9502,
            "switchboard-name"=>"switchboard",
            "debug-mode" =>true,
            "register_key"=>Utils::generate_password(),
            "manage_key"=>Utils::generate_password(10),
            "show-config-when-start"=>false
        ];

        $del_list = ["key"];//陈旧条目列表

        $json = new JSON(__DIR__."/".self::CONFIG_FILE,$config);//加载config
        $jsonCfg = $json->getAll();

        $this->log("Now update config file",LogLevel::NOTICE);
        foreach ($config as $k=>$v){//增加缺失条目
            if(!isset($jsonCfg[$k])) $jsonCfg[$k] = $v;
        }
        foreach($del_list as $v){//删除陈旧条目
            if(isset($jsonCfg[$v])) unset($jsonCfg[$v]);
        }
        $jsonCfg["config-version"] = $config["config-version"];
        $json->setAll($jsonCfg);
        $json->save();

        $this->config = $jsonCfg;
        $this->log("Complete checking , current config version : ".$jsonCfg["config-version"],LogLevel::NOTICE);

        if($jsonCfg["show-config-when-start"]){
            $this->log("show-config-when-start is on,now show your server config",LogLevel::NOTICE);
            foreach($jsonCfg as $k=>$v){
                $this->log($k." | ".$v,LogLevel::NOTICE);
            }
        }

        @define("DEBUG_MODE",$jsonCfg["debug-mode"]);
        if($jsonCfg["debug-mode"]) $this->log(TextFormat::YELLOW."DEBUG MODE IS ENABLED",LogLevel::NOTICE);


    }

    public function showServerInfo(){
        $this->log("\nprotocol version | ".PROTOCOL_VERSION);
        $this->log("\nswitchboard role | ".SERVER_ROLE);
        $this->log("\nplease check key in config.json\n");

    }

    public function start($ip,$port = "config"){
        $this->defineInfo();
        $this->configLoader();
        $this->showServerInfo();
        if($port == "config"){
            parent::start($ip,$this->config["port"]);
        }else{
            parent::start($ip,$port);
        }
    }

    public function onStart(){
        $this->log("SwitchBoardServer:: start on protocol ".PROTOCOL_VERSION);
    }

    function onReceive($swoole, $fd, $from_id, $data)
    {
        $this->log("SwitchBoardServer: receive data from: " . $fd);
    }

    function onConnect($swoole, $fd)
    {
        $this->log("SwitchBoardServer connected by: " . $fd);
    }

    function onClose($swoole, $fd)
    {
        $this->log("SwitchBoardServer disconnected by: " . $fd);
    }

}