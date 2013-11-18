<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * HybridAuth
 *
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 * 
 */

/*
|--------------------------------------------------------------------------
| HybridAuth Config
|--------------------------------------------------------------------------
|
| http://hybridauth.sourceforge.net/userguide/Configuration.html
|
*/

$config['base_url']   = 'social/endpoint';

$config['debug_mode'] =  FALSE; //(ENVIRONMENT === 'development');

$config['debug_file'] = APPPATH.'logs/hybridauth.log';

$config['providers']  = array(

	'OpenID' => array(
		'enabled' => FALSE
	),

	'Yahoo' => array(
		'enabled' => FALSE,
		'keys'    => array('id' => '', 'secret' => ''),
	),

	'AOL'  => array(
		'enabled' => FALSE
	),

	'Google' => array(
		'enabled' => TRUE,
		'keys'    => array('id' => '', 'secret' => ''),
	),

	'Facebook' => array(
		'enabled' => TRUE,
		'keys'    => array('id' => '724526640910679', 'secret' => '0e310ada505a1cb2ee0c76e19d4119b2'),
	),

	'Twitter' => array(
		'enabled' => FALSE,
		'keys'    => array( 'key' => '', 'secret' => '')
	),

	'Live' => array(
		'enabled' => FALSE,
		'keys'    => array('id' => '', 'secret' => '')
	),

	'MySpace' => array(
		'enabled' => FALSE,
		'keys'    => array( 'key' => '', 'secret' => '')
	),

	'LinkedIn' => array(
		'enabled' => FALSE,
		'keys'    => array( 'key' => '', 'secret' => '')
	),

	'Foursquare' => array(
		'enabled' => FALSE,
		'keys'    => array('id' => '', 'secret' => '')
	),

);

/* End of file hybridauth.php */
/* Location: ./application/config/hybridauth.php */