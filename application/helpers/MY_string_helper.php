<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('str_is') )
{
	/**
	 * Determine if a given string matches a given pattern.
	 *
	 * @param  string  $pattern
	 * @param  string  $value
	 * @return bool
	 */
	function str_is($pattern, $value)
	{
		if ($pattern == $value) return TRUE;

		$pattern = preg_quote($pattern, '#');

		// Asterisks are translated into zero-or-more regular expression wildcards
		// to make it convenient to check if the strings starts with the given
		// pattern such as "library/*", making any string check convenient.
		$pattern = str_replace('\*', '.*', $pattern).'\z';

		return (bool) preg_match('#^'.$pattern.'#', $value);
	}
}

if ( ! function_exists('str_slug'))
{
	/**
	 * Generate a URL friendly "slug" from a given string.
	 *
	 * @param  string  $title
	 * @param  string  $separator
	 * @return string
	 */
	function str_slug($title, $separator = '-')
	{
		if ( ! function_exists('convert_accented_characters') )
		{
			$CI =& get_instance();
			$CI->load->helper('text');
		}

		$title = convert_accented_characters($title);

		// Remove all characters that are not the separator, letters, numbers, or whitespace.
		$title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($title));

		// Convert all dashes/undescores into separator
		$flip = $separator == '-' ? '_' : '-';

		$title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

		// Replace all separator characters and whitespace by a single separator
		$title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

		return trim($title, $separator);
	}
}

if ( ! function_exists('start_with') )
{
	/**
	 * Determine if a string starts with a given needle.
	 *
	 * @param  string  $haystack
	 * @param  string|array  $needles
	 * @return bool
	 */
	function starts_with($haystack, $needles)
	{
		foreach ((array) $needles as $needle)
		{
			if (strpos($haystack, $needle) === 0) return TRUE;
		}

		return false;
	}
}

if ( ! function_exists('ends_with') )
{
	/**
	 * Determine if a given string ends with a given needle.
	 *
	 * @param string $haystack
	 * @param string|array $needles
	 * @return bool
	 */
	function ends_with($haystack, $needles)
	{
		foreach ((array) $needles as $needle)
		{
			if ($needle == substr($haystack, strlen($haystack) - strlen($needle))) return TRUE;
		}

		return FALSE;
	}
}

if ( ! function_exists('contains') )
{
	/**
	 * Determine if a given string contains a given sub-string.
	 *
	 * @param  string        $haystack
	 * @param  string|array  $needle
	 * @return bool
	 */
	function contains($haystack, $needle)
	{
		foreach ((array) $needle as $n)
		{
			if (strpos($haystack, $n) !== FALSE) return TRUE;
		}

		return FALSE;
	}
}

/* End of file MY_string_helper.php */
/* Location: ./application/helpers/MY_string_helper.php */