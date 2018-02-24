<?php
namespace switchboard\protocol\defaults;


use switchboard\protocol\Packet;

class ClientConnectPacket extends Packet {
    const NETWORK_ID = 1;

    public $clientName;
    public $clientGroupID;
    public $clientServerIP;
    public $clientServerPort;

    function encode()
    {
        $this->reset();
        $this->putString($this->clientName);
        $this->putInt($this->clientGroupID);
        $this->putString($this->clientServerIP);
        $this->putInt($this->clientServerPort);
    }

    function decode()
    {
        $this->clientName = $this->getString();
        $this->clientGroupID = $this->getInt();
        $this->clientServerIP = $this->getString();
        $this->clientServerPort = $this->getInt();
    }
}