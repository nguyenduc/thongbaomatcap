<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_URI extends CI_URI {

	public function is($patterns)
	{
		if ( ! function_exists('str_is') )
		{
			$CI =& get_instance();
			$CI->load->helper('string');
		}

		$uri_string = ($this->uri_string() !== '') ? $this->uri_string() : '/';
		$patterns = is_array($patterns) ? $patterns : func_get_args();

		foreach ($patterns as $pattern)
		{
			// Sua rac roi khi su dung translate_uri_dashes.
			// Truy cap vao domain.com/forgot-pass 
			// voi domain.com/forgot_pass la nhu nhau.
			// Vi vay chuyen chung ve lam mot.
			$pattern = str_replace('-', '_', $pattern);
			$uri_string = str_replace('-', '_', $uri_string);

			if ( str_is($pattern, $uri_string) )
			{
				return true;
			}
		}

		return false;
	}

}

/* End of file MY_URI.php */
/* Location: ./application/core/MY_URI.php */