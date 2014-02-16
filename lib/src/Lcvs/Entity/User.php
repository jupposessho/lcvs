<?php
namespace Lcvs\Entity;

/**
 * Class User
 * @package Lcvs\Entity
 */
class User
{
	/** @var int */
	private $id;

	/** @var string */
	private $emailAddress;

	/** @var string */
	private $nickName;

	/** @var string */
	private $firstName;

	/** @var string */
	private $lastName;

	/** @var string */
	private $isAdmin;

	/** @var string */
	private $salt;

	/** @var string */
	private $password;

	/**
	 * @param string $isAdmin
	 */
	public function setIsAdmin($isAdmin)
	{
		$this->isAdmin = $isAdmin;
	}

	/**
	 * @return bool
	 */
	public function getIsAdmin()
	{
		return (bool) $this->isAdmin;
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

	/**
	 * @param string $firstName
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @param string $nickName
	 */
	public function setNickName($nickName)
	{
		$this->nickName = $nickName;
	}

	/**
	 * @return string
	 */
	public function getNickName()
	{
		return $this->nickName;
	}

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
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param string $salt
	 */
	public function setSalt($salt)
	{
		$this->salt = $salt;
	}

	/**
	 * @return string
	 */
	public function getSalt()
	{
		return $this->salt;
	}

	/**
	 * Check the password
	 *
	 * @param $password
	 * @return bool
	 */
	public function checkPassword($password)
	{
		return $this->getPassword() == sha1($this->salt.$password);
	}

	/**
	 * Generate password data
	 *
	 * @param string $plain
	 * @throws \InvalidArgumentException
	 */
	public function generatePassword($plain)
	{
		if (false === filter_var($this->getEmailAddress(), FILTER_VALIDATE_EMAIL)) {
			throw new \InvalidArgumentException('Email address must be set');
		}

		$salt = md5(rand(100000, 999999).$this->getEmailAddress());
		$this->setSalt($salt);
		$this->setPassword(sha1($salt.$plain));
	}
}