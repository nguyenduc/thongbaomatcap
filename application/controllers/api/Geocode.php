<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Geocode extends REST_Controller {

	protected $libraries = array('geocoder');

	public function index_get()
	{
		$ip_address = $this->input->ip_address();
		$geocode = $this->geocoder->lookup($ip_address);

		return $this->output->json( array() );
	}

}

/* End of file Geocode.php */
/* Location: ./application/controllers/Api/Geocode.php */