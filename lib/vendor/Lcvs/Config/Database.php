<?php
namespace Lcvs\Config;

class Database
{
	/**
	 * Get application routing
	 *
	 * @param string $name
	 * @throws \Exception
	 * @return array
	 */
	public static function get($name = 'default')
	{
		// @todo szebben
		$connections = array(
			'default' => array(
				'dsn' => sprintf("%s:host=%s;dbname=%s", 'mysql', '127.0.0.1', 'movie'),
				'userName' => 'root',
				'password' => 'root',
			),
		);

		if (!array_key_exists($name, $connections)) {
			throw new \Exception('Connection not found: '.$name);
		}

		return $connections[$name];
	}
}
