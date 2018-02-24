<?php
/**
 * Project "Osmium" 2017
 * Author jasonczc
 * Local.php
 */

namespace osmiumDB;

abstract class Local extends Database{
    /**
     * @var string
     */
    public $file;//local file
    public $storage;
    public $default = null;


    /**
     * @return string
     */
    public function getSourceFile(){
        return file_get_contents($this->file);
    }



    /**
     * localStorage constructor.
     * @param $file
     */
    public function __construct($file,$default = null){
        $this->file = $file;
        $this->setToStorage();
        $this->default = $default;
    }

    /**
     * @return boolean
     */
    abstract function save();

    abstract function setToStorage();
    /**
     * @param $key
     * @return mixed
     */
    public function get($key){
        if(isset($this->storage[$key])){
            return $this->storage[$key];
        }else{
            return null;
        }
    }

    public function getAll(){
        return $this->storage;
    }
    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public function set($key, $value)
    {
            $this->storage[$key] = $value;
            return true;
    }

    /**
     * @param $v
     * @return bool
     */
    public function setAll($v){
        $this->storage = $v;
        return true;
    }

    /**
     * @param $v
     * @return bool
     */
    public function coverAll($v){
        foreach($v as $k=>$v1){
            $this->storage[$k] = $v1;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return bool
     */

    public function setDefault(){
        if(!is_array($this->storage) and $this->default !== null){
            $this->storage = $this->default;
        }
        return true;
    }

}