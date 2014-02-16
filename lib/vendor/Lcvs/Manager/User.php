<?php
namespace Lcvs\Manager;
use Fw\Core\Exception\NotFound;

/**
 * Class User
 * @package Lcvs\Manager
 */
class User
{
	/** @var \Lcvs\Dao\User */
	private $dao;

	/**
	 * @param \Lcvs\Dao\User $dao
	 */
	public function __construct(\Lcvs\Dao\User $dao)
	{
		$this->dao = $dao;
	}

	/**
	 * Insert to database
	 *
	 * @param array $data
	 * @return int
	 */
	public function insert($data)
	{
		$user = $this->getUserFromData($data);
		$this->validate($user);
		$this->dao->insert($user);

		return $user->getId();
	}

	/**
	 * Update a user
	 *
	 * @param array $data
	 */
	public function update($data)
	{
		$user = $this->getUserFromData($data);
		$this->validate($user);
		$this->dao->update($user);
	}

	/**
	 * Get a user by id
	 *
	 * @param int $id
	 * @return \Lcvs\Entity\User
	 */
	public function get($id)
	{
		return $this->dao->get($id);
	}

	/**
	 * Get a user by email address
	 *
	 * @param string $email
	 * @return \Lcvs\Entity\User
	 */
	public function getByEmail($email)
	{
		return $this->dao->getByEmail($email);
	}

	/**
	 * Delete a user
	 *
	 * @param int $id
	 * @throws \Exception
	 */
	public function delete($id)
	{
		$user = $this->getUserFromData(array('id' => $id));
		$result = $this->dao->delete($user);
		if (!$result) {
			throw new \Exception('Delete failed for user: ' . $user->getId());
		}
	}

	/**
	 * Validate user data
	 *
	 * @param \Lcvs\Entity\User $user
	 * @throws \InvalidArgumentException
	 */
	private function validate(\Lcvs\Entity\User $user)
	{
		if (!is_null($user->getId()) && false === filter_var($user->getId(), FILTER_VALIDATE_INT)) {
			throw new \InvalidArgumentException('Id should be an integer');
		}
		if (false === filter_var($user->getEmailAddress(), FILTER_VALIDATE_EMAIL)) {
			throw new \InvalidArgumentException('Invalid email format');
		}
		if (!is_bool($user->getIsAdmin())) {
			throw new \InvalidArgumentException('Is admin should be a boolean');
		}
		if (strlen($user->getPassword()) < 32 || strlen($user->getSalt()) != 32) {
			throw new \InvalidArgumentException('Invalid password');
		}
	}

	/**
	 * Create or modify a user object from the given array
	 *
	 * @param array $data
	 * @throws \Fw\Core\Exception\NotFound
	 * @return \Lcvs\Entity\User
	 */
	private function getUserFromData($data)
	{
		if (array_key_exists('id', $data)) {
			$user = $this->get($data['id']);
			if (!$user) {
				throw new NotFound('User not found: ' . $data['id']);
			}
		} else {
			$user = new \Lcvs\Entity\User();
		}

		if (array_key_exists('email', $data)) {
			$user->setEmailAddress($data['email']);
		}
		if (array_key_exists('first_name', $data)) {
			$user->setFirstName($data['first_name']);
		}
		if (array_key_exists('last_name', $data)) {
			$user->setLastName($data['last_name']);
		}
		if (array_key_exists('nick_name', $data)) {
			$user->setNickName($data['nick_name']);
		}
		if (array_key_exists('admin', $data) && $data['admin'] == '1') {
			$user->setIsAdmin(1);
		} else {
			$user->setIsAdmin(0);
		}
		if (array_key_exists('password', $data)) {
			$user->generatePassword($data['password']);
		}

		return $user;
	}
}