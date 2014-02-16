<?php
namespace Lcvs\Entity;

/**
 * Class Hire
 * @package Lcvs\Entity
 */
class Hire
{
	/** @var int */
	private $id;

	/** @var string */
	private $movieTitle;

	/** @var string */
	private $emailAddress;

	/** @var string */
	private $takeDate;

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string $movieTitle
	 */
	public function setMovieTitle($movieTitle)
	{
		$this->movieTitle = $movieTitle;
	}

	/**
	 * @return string
	 */
	public function getMovieTitle()
	{
		return $this->movieTitle;
	}

	/**
	 * @param string $takeDate
	 */
	public function setTakeDate($takeDate)
	{
		$this->takeDate = $takeDate;
	}

	/**
	 * @return string
	 */
	public function getTakeDate()
	{
		return $this->takeDate;
	}

	/**
	 * @param string $emailAddress
	 */
	public function setEmailAddress($emailAddress)
	{
		$this->emailAddress = $emailAddress;
	}

	/**
	 * @return string
	 */
	public function getEmailAddress()
	{
		return $this->emailAddress;
	}
}