<?php
namespace Lcvs\Dao;

/**
 * Class Hire
 * @package Lcvs\Dao
 */
class Hire
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
	 * Get hired movies
	 *
	 * @return \Lcvs\Entity\Hire[]
	 */
	public function getHired()
	{
		$sql = "
			SELECT
				h.id,
				h.take          AS takenDate,
				m.title         AS movieTitle,
				u.email_address AS emailAddress
			FROM hire h
			LEFT JOIN movie m ON m.id = h.movie_id
			LEFT JOIN user u ON u.id = h.user_id
			ORDER BY take DESC
		";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_OBJ);
	}
}