<?php
/**
 * PHP Error Log
 * @author corriezhao
 *
 */

namespace Core\Logger;

class PHP extends \Core\Logger {

    public function __construct($config) {}

    protected function write(){
        if(!empty($this->messages)){
            error_log($message);
        }
    }

}