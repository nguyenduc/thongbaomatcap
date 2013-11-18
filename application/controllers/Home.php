<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Publish_Controller implements Home_Interface {

	public function index()
	{
		return $this->template->build('home/index');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */