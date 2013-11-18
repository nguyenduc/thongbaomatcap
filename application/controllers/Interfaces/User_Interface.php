<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface User_Interface {

	/**
	 * Hien thi thong tin nguoi dung.
	 * 
	 * @return string
	 */
	public function index();

	/**
	 * Giong voi index, chi goi lai method index.
	 * 
	 * @return string
	 */
	public function dashboad();

	/**
	 * Dang nhap cua user.
	 * 
	 * @return string
	 */
	public function login();

	/**
	 * User dang ky.
	 * 
	 * @return string
	 */
	public function register();

	/**
	 * User quen mat khau
	 * 
	 * @return string
	 */
	public function forgot_pass();

}

/* End of file User_Interface.php */
/* Location: ./application/controllers/Interfaces/User_Interface.php */