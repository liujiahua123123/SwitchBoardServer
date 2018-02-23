<?php
namespace content\server;
use content\core\TCPServerBase;

class SwitchBoardServer extends TCPServerBase{


    public function onReady()
    {
        $this->log("SwitchBoardServer: ready");
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