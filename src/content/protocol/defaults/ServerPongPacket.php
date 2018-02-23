<?php
namespace content\protocol\defaults;

use content\protocol\Packet;

class ServerPongPacket extends Packet {

    protected $message = "+PONG";
    public $note = "connected";


    function encode()
    {
        $this->putString($this->message);
        $this->putString($this->note);
    }

    function decode()
    {
        $this->message = $this->getString();
        $this->note = $this->getString();
    }

}