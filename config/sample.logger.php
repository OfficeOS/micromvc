<?php

$config = array();

$config['logger'] = array(
	'default' => array(
	    'driver' => 'file',
	    'dir' => SP . 'storage/log/',
	    'level' => \Core\Logger::LEVEL_DEBUG,
	)
);