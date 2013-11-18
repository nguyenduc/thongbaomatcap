<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Input extends CI_Input {

	/**
	 * [__construct description]
	 * 
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * [input description]
	 * 
	 * @param  [type]  $type      [description]
	 * @param  boolean $xss_clean [description]
	 * @return [type]             [description]
	 */
	public function input($type, $xss_clean = FALSE)
	{
		$data = ($type === 'post') ?
			$this->post(NULL, $xss_clean) :
			$this->get(NULL, $xss_clean);

		return new Input_Data($data);
	}

}

class Input_Data {

	/**
	 * [$input description]
	 * 
	 * @var array
	 */
	protected $input = array();

	/**
	 * [__construct description]
	 * 
	 * @param [type] $type [description]
	 */
	public function __construct(array $input)
	{
		// Set input data
		$this->input = $input;

		// Load array helper
		$CI =& get_instance();
		$CI->load->helper('array');
	}

	/**
	 * Get all of the input for the request.
	 *
	 * @return array
	 */
	public function all()
	{		
		return $this->input;
	}

	/**
	 * Retrieve an input item from the request.
	 *
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return string
	 */
	public function get($key = null, $default = null)
	{
		return array_get($this->input, $key, $default);
	}

	/**
	 * Determine if the request contains a given input item.
	 *
	 * @param  string|array  $key
	 * @return bool
	 */
	public function has($key)
	{
		if (count(func_get_args()) > 1)
		{
			foreach (func_get_args() as $value)
			{
				if ( ! $this->has($value)) return false;
			}

			return true;
		}

		if (is_bool($this->get($key)) or is_array($this->get($key)))
		{
			return true;
		}

		return trim((string) $this->get($key)) !== '';
	}


	/**
	 * Get a subset of the items from the input data.
	 *
	 * @param  array  $keys
	 * @return array
	 */
	public function only($keys)
	{
		$keys = is_array($keys) ? $keys : func_get_args();

		return array_only($this->get(), $keys) + array_fill_keys($keys, null);
	}

	/**
	 * Get all of the input except for a specified array of items.
	 *
	 * @param  array  $keys
	 * @return array
	 */
	public function except($keys)
	{
		$keys = is_array($keys) ? $keys : func_get_args();

		$results = $this->get();

		foreach ($keys as $key) array_forget($results, $key);

		return $results;
	}

}

/* End of file MY_Input.php */
/* Location: ./application/core/MY_Input.php */