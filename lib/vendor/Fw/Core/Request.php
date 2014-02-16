<?php

namespace Fw\Core;

/**
 * Class Request
 * @package Fw\Core
 */
class Request
{
	private $_parameters = array();

	/**
	 * Constructor
	 */
	public function  __construct()
	{
		$this->init();
	}

	public function init()
	{
		$this->_parameters             = array_merge($_GET, $_POST);
		$this->_parameters['method']   = $_SERVER['REQUEST_METHOD'];
		$this->_parameters['protocol'] = $_SERVER['SERVER_PROTOCOL'];
		$this->_parameters['uri']      = $_SERVER['REQUEST_URI'];
		if (array_key_exists('PHP_AUTH_USER', $_SERVER)) {
			$this->_parameters['authUser'] = $_SERVER['PHP_AUTH_USER'];
			if (array_key_exists('PHP_AUTH_PW', $_SERVER)) {
				$this->_parameters['authPass'] = $_SERVER['PHP_AUTH_PW'];
			}
		}
	}

	/**
	 * Get request parameter
	 *
	 * @param string $name
	 * @param string $default
	 * @return string
	 */
	public function getParameter($name, $default = null)
	{
		return $this->hasParameter($name) ? $this->_parameters[$name] : $default;
	}

	/**
	 * True if the request contains the given parameter
	 *
	 * @param string $name
	 * @return bool
	 */
	public function hasParameter($name)
	{
		return isset($this->_parameters[$name]);
	}

	/**
	 * Set tha parameter
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	public function setParameter($name, $value)
	{
		$this->_parameters[$name] = $value;
	}

	/**
	 * Get request parameters
	 *
	 * @return array
	 */
	public function getParameters()
	{
		return $this->_parameters;
	}
}