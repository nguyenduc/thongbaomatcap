<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/third_party/hybridauth/Hybrid/Auth.php';

class CI_HybridAuth extends Hybrid_Auth {

	public function __construct($config = array())
	{		
		$ci =& get_instance();
		$ci->load->helper('url_helper');

		$config['base_url'] = site_url($config['base_url']);

		parent::__construct($config);
	}

	public static function providerEnabled($provider)
	{
		return isset(parent::$config['providers'][$provider]) && parent::$config['providers'][$provider]['enabled'];
	}

}

/* End of file HybridAuth.php */
/* Location: ./application/libraries/HybridAuth.php */