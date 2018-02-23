<?php
namespace content\core;
abstract class TCPServerBase{

    /** @var \swoole_server */
    public $swoole = null;

    protected $setting = [];

    public function __construct()
    {

    }


    public function start($ip,$port){
        $this->onLoad();
        $this->swoole = new \swoole_server($ip,$port);
        if(count($this->setting)!==0)$this->swoole->set($this->setting);
        $this->swoole->start();
        $this->onStart();
        $this->swoole->on('receive',[$this,'onReceive']);
        $this->swoole->on('connect',[$this,'onConnect']);
        $this->swoole->on('close',[$this,'onClose']);
    }
    public function isStart(){
        return $this->swoole !== null;
    }
    public function onStart(){

    }
    public function onLoad(){

    }
    public function setting($setting){

    }

    abstract function onReceive($swoole,$fd,$from_id,$data);

    abstract function onConnect($swoole,$fd);

    abstract function onClose($swoole,$fd);


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