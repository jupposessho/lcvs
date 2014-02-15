<?php
namespace Lcvs;
use Lcvs\Config\Database;
use Lcvs\Dao\Movie;
use Lcvs\Manager\Hire;

/**
 * Class Factory
 * @package Lcvs
 */
class Factory
{
	/**
	 * Create instance
	 *
	 * @return Factory
	 */
	public static function create()
	{
		return new Factory();
	}

	public function createMovieManager()
	{
		return new \Lcvs\Manager\Movie($this->createMovieDao());
	}

	/**
	 * Create dao for movie
	 *
	 * @return Movie
	 */
	public function createMovieDao()
	{
		return new Movie($this->createConnection());
	}

	/**
	 * Create database connection
	 *
	 * @param string $name
	 * @return \PDO
	 */
	private function createConnection($name = 'default')
	{
		$config = Database::get($name);

		return new \PDO($config['dsn'], $config['userName'], $config['password']);
	}

	/**
	 * Create hire manager
	 *
	 * @return Hire
	 */
	public function createHireManager()
	{
		return new Hire(new \Lcvs\Dao\Hire($this->createConnection()));
	}
} 