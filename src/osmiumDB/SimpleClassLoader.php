<?php
/**
 * Author jasonczc
 */

namespace osmiumDB;


class SimpleClassLoader{
    public function __construct(){
    }

    /**
     * @param $path
     * @param bool $willFindRoot
     * @return bool isSucceed
     */
    public function readPath($path,$willFindRoot = false){
        if (!is_dir($path)) return false;
        $path = $this->transFormDic($path);
        $files = scandir($path);
        unset($files[0], $files[1]);
        foreach ($files as $v) {
            if (is_dir($path . $v)) {
                if ($willFindRoot) {
                    $this->readPath($this->transFormDic($path . $v), true);
                }
            } else {
                if (strtolower($this->getFileType($v)) == 'php'){
                   if(!class_exists($this->getFileName($v)))
                    require_once $path . $v;
                }
            }
        }
        return true;
    }

    /**
     * @param $path
     * @return string
     */
    public function transFormDic($path){
        $var = trim($path);
        $len = strlen($var) - 1;
        $end = $var[$len];
        if($end == DIRECTORY_SEPARATOR) return $path;
        return $path.DIRECTORY_SEPARATOR;
    }

    /**
     * @param $file filename
     * @return bool|string
     */
    public function getFileType($file){
        return substr(strrchr($file,'.'),1);
    }
    public function getFileName($file){
        return basename($file,".".$this->getFileType($file));
    }
}