<?php
/**
 * File Logger
 * @author corriezhao
 *
 */

namespace Core\Logger;

class File extends \Core\Logger {
    private $_dir = '';
    
    public function __construct($config) {
        $this->_dir = $config['dir'];
        $this->level = $config['level'];
    }

    protected function write(){
        if(!empty($this->messages))
        {
            $dir = $this->_dir;
            if (!is_dir($dir)) 
            {
                mkdir($dir, 0777);
                chmod($dir, 0777);
            }
            $dir = $this->_dir . '/' . date('Ymd');
            if (!is_dir($dir)) 
            {
                mkdir($dir, 0777);
                chmod($dir, 0777);
            }
            $messages_wraper = array();
            foreach($this->messages as $message)
            {
                $messages_wraper[$message['level']][] = '[' . date('Y-m-d H:i:s', $message['time']) . '] ' . ($message['id'] ? "#{$message['id']} " : '') . $message['text'];
            }
            
            foreach ($messages_wraper as $level => $wraper)
            {
                $file = $this->_dir . '/' . date('Ymd') . '/' . $level . '.log';
                file_put_contents($file, join(PHP_EOL, $wraper) . PHP_EOL, FILE_APPEND);
            }
        }
    }

}