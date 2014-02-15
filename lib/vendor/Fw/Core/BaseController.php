<?php
namespace Fw\Core;

/**
 * Class BaseController
 * @package Fw\Core
 */
class BaseController
{
	/** @var string */
	protected $moduleName;

	/** @var string */
	protected $actionName;

	/** @var array */
	protected $_var;

	/**
	 * Construct method
	 *
	 * @param string $moduleName
	 * @param string $actionName
	 */
	public function  __construct($moduleName, $actionName)
	{
		$this->moduleName   = $moduleName;
		$this->actionName   = $actionName;
		$this->_var         = array();
	}

	/**
	 * Set parameter to the template
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	protected function assign($name, $value)
	{
		$this->_var[$name] = $value;
	}

	/**
	 * Get parameter value
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function getValue($name)
	{
		return isset($this->_var[$name]) ? $this->_var[$name] : null;
	}

	/**
	 * Renders a template
	 */
	public function render()
	{
	}

	/**
	 * Redirects to specified url
	 *
	 * @param string $url
	 */
	function redirect($url)
	{
		header("307 Temporary Redirect HTTP/1.1");
		header('location: ' . $url);
		exit;
	}
}