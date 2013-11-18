<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Zend {
	
	public function __construct()
	{
		$zend_path = APPPATH . 'third_party/zendframework/library';
		set_include_path(get_include_path() . PATH_SEPARATOR . $zend_path);
	}

	public function load($class)
	{
		$zend_lib = realpath(dirname(__FILE__));
		require_once $class . '.php';
	}

	public function register_autoloader()
	{
		require_once 'Zend/Loader/Autoloader.php';
		Zend_Loader_Autoloader::getInstance();
	}

}

/* End of file Zend.php */
/* Location: ./application/libraries/Zend.php */