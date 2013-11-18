<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Output extends CI_Output {

	public function json(array $output)
	{
		return $this->enable_profiler(FALSE)
			->set_content_type('application/json')
			->set_output(json_encode($output));
	}
	
}

/* End of file MY_Output.php */
/* Location: ./application/core/MY_Output.php */