<?php
/**
 * File Logger
 *
 * @author corriezhao <hfcorriez@gmail.com>
 *
 */

namespace Core\Logger;

class File extends \Core\Logger
{
    private $_dir = '';
    private $_prefix = '';
    private $_filename = ':date/:level.log';
    private $_message = '[:datetime] :text #:id';

    public function __construct($config)
    {
        $this->_dir = $config['dir'];
        if (!empty($config['prefix'])) $this->_prefix = $config['prefix'];
        if (!empty($config['filename'])) $this->_filename = $config['filename'];
        if (!empty($config['message'])) $this->_message = $config['message'];
        $this->_level = $config['level'];
        if (isset($config['sync'])) $this->_sync = $config['sync'];
    }

    protected function write()
    {
        if (empty($this->_messages)) return;

        $dir_exists = array();

        foreach ($this->_messages as $message) {
            $replace = array();
            foreach ($message as $k => $v) $replace[':' . $k] = $v;

            $message_text = strtr($this->_message, $replace);
            $filename = rtrim($this->_dir, '/') . '/' . strtr($this->_filename, $replace);
            $dir = dirname($filename);
            if (!in_array($dir, $dir_exists) && !is_dir($dir)) {
                mkdir($dir, 0777, true);
                $dir_exists[] = $dir;
            }

            file_put_contents($filename, $message_text . PHP_EOL, FILE_APPEND);
        }
    }

}