<?php
namespace Fw\Core;
use Lcvs\Config\Routing;

/**
 * Class Application
 * @package Fw\Core
 */
class Application
{
	/**
	 * Constructor
	 */
	public function  __construct()
	{
		set_exception_handler(array($this, 'handleException'));
	}

	/**
	 * Run the application
	 */
	public function run()
	{
		$request    = new Request();
		$router     = new Router(Routing::get());
		$match      = $router->match($request);
		$matchArray = explode('/', $match);
		$vendorName = $matchArray[0];
		$moduleName = $matchArray[1];
		$actionName = $matchArray[2];
		$module     = sprintf('\%s\Controller\%s', $vendorName, $moduleName);
		$action     = 'execute'.$actionName;
		$controller = new $module($moduleName, $actionName);
		if (!method_exists($controller, $action)) {
			throw new \Exception(sprintf('Invalid action: %s in module %s', $actionName, $moduleName));
		}

		/** @var Response $response */
		$response = $controller->$action($request);
		$response->send();
	}

	/**
	 * Handle the exception
	 *
	 * @param \Exception $e
	 */
	public function handleException(\Exception $e)
	{
		$response = new Response(array(
			'success' => false,
			'error'   => $e->getMessage(),
		));
		$response->send();
	}
}