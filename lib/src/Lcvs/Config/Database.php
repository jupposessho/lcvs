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
		$connections = array(
			'default' => array(
				'type'     => 'mysql',
				'host'     => '127.0.0.1',
				'user'     => 'root',
				'password' => 'root',
				'name'     => 'movie',
			),
		);

		if (!array_key_exists($name, $connections)) {
			throw new \Exception('Connection not found: '.$name);
		}

		$conn = $connections[$name];
		return array(
			'dsn'      => sprintf("%s:host=%s;dbname=%s", $conn['type'], $conn['host'], $conn['name']),
			'user'     => $conn['user'],
			'password' => $conn['password']
		);
	}
}
