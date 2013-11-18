<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * Cac model duoc tu dong load.
	 * 
	 * @var [type]
	 */
	protected $models = array();

	/**
	 * Cac thu vien duoc tu dong load.
	 * 
	 * @var array
	 */
	protected $libraries = array();
	
	/**
	 * Cac helpers duoc tu dong load.
	 * 
	 * @var array
	 */
	protected $helpers = array();
	
	/**
	 * [$layout description]
	 * 
	 * @var [type]
	 */
	protected $layout;

	/**
	 * [__construct description]
	 * 
	 */
	public function __construct()
	{
		parent::__construct();
		
		// Auto-load, cau hinh he thong...
		$this->_autoload();

		// Neu site o che do maintenance
		$maintenance_detect = '*thongbaomatcap.info*';
		
		if( $this->config->item('maintenance_mode') && str_is($maintenance_detect, site_url() ) )
		{
			$this->_maintenance_mode();
		}

		// Thiet lap layout mac dinh
		if( ! is_null($this->layout) )
		{
			$this->template->set_layout($this->layout);
		}

		// ENVIRONMENT Setup
		if (ENVIRONMENT == 'development' && ! $this->input->is_ajax_request() )
		{
			$this->output->enable_profiler(TRUE);
		}

	}

	/**
	 * [_autoload description]
	 * 
	 * @return [type] [description]
	 */
	protected function _autoload()
	{
		$data = array(
			'models'    => 'model',
			'libraries' => 'library',
			'helpers'   => 'helper'
		);
		
		foreach ($data as $var => $load)
		{
			if ( is_array($this->{$var}) && ! empty($this->{$var}) )
			{
				foreach ($this->{$var} as $data)
				{
					$this->load->{$load}($data);
				}
			}
		}
	}

	/**
	 * [maintenance_mode description]
	 * 
	 * @return [type] [description]
	 */
	protected function _maintenance_mode()
	{
		include APPPATH . 'views/maintenance.php';
		exit();
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */