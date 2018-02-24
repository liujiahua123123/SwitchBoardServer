<?php
/**
 * Project "Osmium" 2017
 * Author jasonczc
 * net.php
 */
namespace osmiumDB;

abstract class Net extends Database {
    /**
     * @var object
     */
    public $storageObj;

    /**
     * @param $obj
     * @return boolean
     */
    abstract function verifyObj($obj);

    /**
     * @param $obj
     * @return boolean
     */
    abstract function testConnectObj($obj);

    public function get($key){
        return null;
    }

    public function set($key,$value){
        return null;
    }

    public function multiSet($value){
        return null;
    }

    /**
     * @return mixed
     */

    public function getObj(){
        return $this->storageObj;
    }
}