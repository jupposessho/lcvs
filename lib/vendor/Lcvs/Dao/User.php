<?php
namespace Lcvs\Dao;
use Fw\Core\Exception\Database;

/**
 * Class User
 * @package Lcvs\Dao
 */
class User
{
	/** @var \PDO */
	private $conn;

	/**
	 * @param \PDO $conn
	 */
	public function __construct(\PDO $conn)
	{
		$this->conn = $conn;
	}

	/**
	 * Get a user by id
	 *
	 * @param int $id
	 * @throws \Fw\Core\Exception\Database
	 * @return mixed
	 */
	public function get($id)
	{
		$sql = "
			SELECT
				id,
				nick_name     AS nickName,
				first_name    AS firstName,
				last_name     AS lastName,
				email_address AS emailAddress,
				is_admin      AS isAdmin,
				created_at    AS created_at,
				salt,
				password
			FROM user
			WHERE id = :id
		";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $id);
		$result = $stmt->execute();
		if (!$result) {
			throw new Database('Database error', 500);
		}

		return $stmt->fetchObject('\Lcvs\Entity\User');
	}

	/**
	 * Get a user by email address
	 *
	 * @param string $email
	 * @throws \Fw\Core\Exception\Database
	 * @return \Lcvs\Entity\User
	 */
	public function getByEmail($email)
	{
		$sql = "
			SELECT
				id,
				nick_name     AS nickName,
				first_name    AS firstName,
				last_name     AS lastName,
				email_address AS emailAddress,
				is_admin      AS isAdmin,
				created_at    AS created_at,
				salt,
				password
			FROM user
			WHERE email_address = :email
		";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':email', $email);
		$result = $stmt->execute();
		if (!$result) {
			throw new Database('Database error', 500);
		}

		return $stmt->fetchObject('\Lcvs\Entity\User');
	}

	/**
	 * Insert a record to the database
	 *
	 * @param \Lcvs\Entity\User $user
	 * @throws \Fw\Core\Exception\Database
	 */
	public function insert(\Lcvs\Entity\User $user)
	{
		$sql = "
			INSERT INTO user
				(nick_name, first_name, last_name, email_address, salt, password, is_admin, created_at)
			VALUES (:nickName, :firstName, :lastName, :email, :salt, :password, :isAdmin, NOW())
		";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':nickName', $user->getNickName());
		$stmt->bindValue(':firstName', $user->getFirstName());
		$stmt->bindValue(':lastName', $user->getLastName());
		$stmt->bindValue(':email', $user->getEmailAddress());
		$stmt->bindValue(':salt', $user->getSalt());
		$stmt->bindValue(':password', $user->getPassword());
		$stmt->bindValue(':isAdmin', $user->getIsAdmin(), \PDO::PARAM_BOOL);
		$result = $stmt->execute();
		if (!$result) {
			throw new Database('Database error', 500);
		}

		$user->setId($this->conn->lastInsertId());
	}

	/**
	 * Update a record
	 *
	 * @param \Lcvs\Entity\User $user
	 * @throws \Fw\Core\Exception\Database
	 */
	public function update(\Lcvs\Entity\User $user)
	{
		$sql = "
			UPDATE user
			SET
				nick_name = :nickName,
				first_name = :firstName,
				last_name = :lastName,
				email_address = :email,
				salt = :salt,
				password = :password,
				is_admin = :isAdmin
			WHERE
				id = :id
		";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':nickName', $user->getNickName());
		$stmt->bindValue(':firstName', $user->getFirstName());
		$stmt->bindValue(':lastName', $user->getLastName());
		$stmt->bindValue(':email', $user->getEmailAddress());
		$stmt->bindValue(':salt', $user->getSalt());
		$stmt->bindValue(':password', $user->getPassword());
		$stmt->bindValue(':isAdmin', $user->getIsAdmin(), \PDO::PARAM_BOOL);
		$stmt->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
		$result = $stmt->execute();
		if (!$result) {
			throw new Database('Database error', 500);
		}
	}

	/**
	 * Delete a user
	 *
	 * @param \Lcvs\Entity\User $user
	 * @throws \Fw\Core\Exception\Database
	 * @return bool
	 */
	public function delete(\Lcvs\Entity\User $user)
	{
		$sql = "
			DELETE FROM user
			WHERE id = :id
		";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $user->getId());
		$result = $stmt->execute();
		if (!$result) {
			throw new Database('Database error', 500);
		}
		return true;
	}
}