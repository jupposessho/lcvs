<?php
namespace Lcvs\Manager;

/**
 * Class Hire
 * @package Lcvs\Manager
 */
class Hire
{
	/** @var \Lcvs\Dao\Hire */
	private $dao;

	/**
	 * @param \Lcvs\Dao\Hire $dao
	 */
	public function __construct(\Lcvs\Dao\Hire $dao)
	{
		$this->dao = $dao;
	}

	/**
	 * Get hired movies
	 *
	 * @return \Lcvs\Entity\Hire[]
	 */
	public function getHired()
	{
		return $this->dao->getHired();
	}
}