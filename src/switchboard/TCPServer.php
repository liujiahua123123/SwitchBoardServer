<?php
namespace switchboard;

use switchboard\utils\Logger;

abstract class TCPServer{
    /** @var \swoole_server */
    public $swoole = null;

    protected $setting = [];

    public function start($ip,$port){
        $this->onLoad();
        $this->swoole = new \swoole_server($ip,$port);
        if(count($this->setting)!==0)$this->swoole->set($this->setting);
        $this->swoole->on('Start',array($this,'onStart'));
        $this->swoole->on('Receive',[$this,'onReceive']);
        $this->swoole->on('Connect',[$this,'onConnect']);
        $this->swoole->on('Close',[$this,'onClose']);
        $this->swoole->start();
    }


    public function isStart(){
        return $this->swoole !== null;
    }


    public function onLoad(){

    }


    public function setting($setting){

    }

    public function log($message){
        Logger::log($message);
    }

    public function closeConnection($fd){
        return $this->swoole->close($fd);
    }
    public function forceCloseConnection($fd){
        $this->swoole->close($fd,true);
    }

    public function send($fd,$data,$fromId = 0){
        $this->swoole->send($fd,$data,$fromId);
    }
}