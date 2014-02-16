<?php
namespace Fw\Core;
use Fw\Core\Exception\NotFound;

/**
 * Class Router
 * @package Fw\Core
 */
class Router
{
	/** @var array */
	private $rules;

	/**
	 * @param $routes
	 */
	public function __construct($routes)
	{
		$this->rules = $routes;
	}

	/**
	 * Find a routing to match
	 *
	 * @param Request $request
	 * @return string
	 * @throws NotFound
	 */
	public function match(Request $request)
	{
		$uri = urldecode($request->getParameter('uri'));
		foreach ($this->rules as $key => $rule) {
			if (preg_match('~^'.$rule['url'].'$~i', $uri, $params)
				&& $request->getParameter('method') == $rule['method']
			) {
				if ('PUT' == $request->getParameter('method')) {
					parse_str(file_get_contents('php://input'), $putParams);
					$params = array_merge($params, $putParams);
				}
				foreach ($params as $k => $param) {
					if (!is_numeric($k)) {
						$request->setParameter($k, $param);
					}
				}
				return $key;
			}
		}

		throw new NotFound('Page Not Found', 404);
	}
} 