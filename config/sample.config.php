<?php
/**
 * Config
 *
 * Core system configuration file
 *
 * @package		MicroMVC
 * @author		David Pennington
 * @copyright	(c) 2010 MicroMVC Framework
 * @license		http://micromvc.com/license
 ********************************** 80 Columns *********************************
 */
$config = array();

// Base site url - Not currently supported!
$config['site_url'] = '/';

// Enable debug mode?
$config['debug_mode'] = TRUE;

// Load boostrap file?
$config['bootstrap'] = FALSE;

// Available translations (Array of Locales)
$config['languages'] = array('en');

// Timezone
$config['tiemzone'] = 'UTC';

/**
 * Database
 *
 * This system uses PDO to connect to MySQL, SQLite, or PostgreSQL.
 * Visit http://us3.php.net/manual/en/pdo.drivers.php for more info.
 */
$config['database'] = array(
    'default' => array(
    	'dns' => "mysql:host=127.0.0.1;port=3306;dbname=micromvc",
    	'username' => 'root',
    	'password' => '',
    	//'dns' => "pgsql:host=localhost;port=5432;dbname=micromvc",
    	//'username' => 'postgres',
    	//'password' => 'postgres',
    	'params' => array()
	)
);


/**
 * System Events
 */
$config['events'] = array(
	//'pre_controller'	=> 'Class::method',
	//'post_controller'	=> 'Class::method',
);

/**
 * Cookie Handling
 *
 * To insure your cookies are secure, please choose a long, random key!
 * @link http://php.net/setcookie
 */
$config['cookie'] = array(
	'key' => 'very-secret-key',
	'timeout' => time()+(60*60*4), // Ignore submitted cookies older than 4 hours
	'expires' => 0, // Expire on browser close
	'path' => '/',
	'domain' => '',
	'secure' => '',
	'httponly' => '',
);

// Logger config
$config['logger'] = array(
    'default' => array(
        'driver' => 'file',
        'dir' => SP . 'storage/log/',
        'level' => \Core\Logger::LEVEL_DEBUG,
    )
);

// Route
$config['routes'] = array(
	''					=> '\Controller\Index',
	'404'				=> '\Controller\Page404',
	'school'			=> '\Controller\School',
);


/**
 * API Keys and Secrets
 *
 * Insert you API keys and other secrets here.
 * Use for Akismet, ReCaptcha, Facebook, and more!
 */

//$config['XXX_api_key'] = '...';

return $config;

