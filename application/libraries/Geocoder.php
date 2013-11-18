<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/geoip/src/geoipcity.inc';
require_once APPPATH . 'third_party/geoip/src/timezone.php';

class Geocoder {

	/**
	 * [$dat_file description]
	 * 
	 * @var [type]
	 */
	protected $dat_file;

	/**
	 * [$open_flag description]
	 * 
	 * @var [type]
	 */
	protected $open_flag;

	/**
	 * [$CI description]
	 * 
	 * @var [type]
	 */
	protected $CI;

	/**
	 * [__construct description]
	 * 
	 * @param [type] $dat_file  [description]
	 * @param [type] $open_flag [description]
	 */
	public function __construct( array $config = array() )
	{
		$this->initialize($config['dat_file'], $config['open_flag']);
	}

	/**
	 * [initialize description]
	 * 
	 * @param  [type] $dat_file  [description]
	 * @param  [type] $open_flag [description]
	 * @return [type]            [description]
	 */
	public function initialize($dat_file, $open_flag = NULL)
	{
		$this->dat_file = is_file($dat_file) ? $dat_file : APPPATH . 'third_party/geoip/data/GeoLiteCity.dat';
		$this->open_flag = null === $open_flag ? GEOIP_STANDARD : $open_flag;
	}

	/**
	 * [lookup description]
	 * 
	 * @param  [type] $ip_address [description]
	 * @return [type]             [description]
	 */
	public function lookup($ip_address = NULL)
	{
		$CI =& get_instance();
		$ip_address = is_null($ip_address) ? $CI->input->ip_address() : trim($ip_address);

		if (false === filter_var($ip_address, FILTER_VALIDATE_IP))
		{
			log_message('error', 'IP-Address Invalid!');
			return false;
		}

		$geoip = geoip_open($this->dat_file, $this->open_flag);
		$geoip_record = GeoIP_record_by_addr($geoip, $ip_address);

		geoip_close($geoip);

		if (false === $geoip_record instanceof geoiprecord)
		{
			log_message('error', 'GeoIP error!');
			return false;
		}

		return new Geocoder_Result($geoip_record);
	}

}


class Geocoder_Result {
	
	/**
	 * [$geoip_record description]
	 * 
	 * @var [type]
	 */
	protected $geoip_record;

	/**
	 * [__construct description]
	 * 
	 * @param geoiprecord $geoip_record [description]
	 */
	public function __construct( geoiprecord $geoip_record)
	{
		$this->geoip_record = $geoip_record;
	}

	/**
	 * [record description]
	 * 
	 * @return [type] [description]
	 */
	public function record()
	{
		return $this->geoip_record;
	}

	/**
	 * [timezone description]
	 * 
	 * @return [type] [description]
	 */
	public function timezone()
	{
		return get_time_zone($this->country_code(), $this->region());
	}

	/**
	 * [country_code description]
	 * 
	 * @return [type] [description]
	 */
	public function country_code()
	{
		return $this->geoip_record->country_code;
	}

	/**
	 * [country_code3 description]
	 * 
	 * @return [type] [description]
	 */
	public function country_code3()
	{
		return $this->geoip_record->country_code3;
	}

	/**
	 * [country_name description]
	 * 
	 * @return [type] [description]
	 */
	public function country_name()
	{
		return $this->geoip_record->country_name;
	}

	/**
	 * [region description]
	 * 
	 * @return [type] [description]
	 */
	public function region()
	{
		return $this->geoip_record->region;
	}

	/**
	 * [region_name description]
	 * 
	 * @param  boolean $asvn [description]
	 * @return [type]        [description]
	 */
	public function region_name($asvn = TRUE)
	{
		include dirname(__FILE__) . '/src/geoipregionvars.php';

		if( $asvn === TRUE )
		{
			$CI =& get_instance();
			$CI->load->config('region', TRUE);
			$GEOIP_REGION_NAME = array_merge($GEOIP_REGION_NAME, $CI->config->item('region'));
		}

		return isset($GEOIP_REGION_NAME[$this->country_code()][$this->region()]) ?
					$GEOIP_REGION_NAME[$this->country_code()][$this->region()] :
					null;
	}

	/**
	 * [city description]
	 * 
	 * @return [type] [description]
	 */
	public function city()
	{
		return $this->geoip_record->city;
	}

	/**
	 * [postal_code description]
	 * 
	 * @return [type] [description]
	 */
	public function postal_code()
	{
		return $this->geoip_record->postal_code;
	}

	/**
	 * [latitude description]
	 * 
	 * @return [type] [description]
	 */
	public function latitude()
	{
		return $this->geoip_record->geoip_record;
	}

	/**
	 * [longitude description]
	 * 
	 * @return [type] [description]
	 */
	public function longitude()
	{
		return $this->geoip_record->longitude;
	}

	/**
	 * [area_code description]
	 * 
	 * @return [type] [description]
	 */
	public function area_code()
	{
		return $this->geoip_record->area_code;
	}

	/**
	 * [dma_code description]
	 * 
	 * @return [type] [description]
	 */
	public function dma_code()
	{
		return $this->geoip_record->geoip_record;
	}

	/**
	 * [metro_code description]
	 * 
	 * @return [type] [description]
	 */
	public function metro_code()
	{
		return $this->geoip_record->metro_code;
	}

	/**
	 * [continent_code description]
	 * 
	 * @return [type] [description]
	 */
	public function continent_code()
	{
		return $this->geoip_record->continent_code;
	}

}

/* End of file Geocoder.php */
/* Location: ./application/libraries/geoip/Geocoder.php */