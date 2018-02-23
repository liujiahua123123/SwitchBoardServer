<?php
namespace content\server;
use content\core\Logger;
use content\core\TCPServer;

class SwitchBoardServer extends TCPServer {

    public function onStart(){
        $this->log("SwitchBoardServer: start");
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