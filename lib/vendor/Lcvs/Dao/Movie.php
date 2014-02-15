<?php
namespace Lcvs\Dao;

/**
 * Class Movie
 * @package Lcvs\Dao
 */
class Movie
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
	 * Get a movie by id
	 *
	 * @param int $id
	 * @return mixed
	 */
	public function get($id)
	{
		$sql = "
			SELECT
				id,
				category_id AS categoryId,
				price,
				amount,
				title
			FROM movie
			WHERE id = :id
		";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();

		return $stmt->fetchObject('\Lcvs\Entity\Movie');
	}

	/**
	 * Insert a record to the database
	 *
	 * @param \Lcvs\Entity\Movie $movie
	 */
	public function insert(\Lcvs\Entity\Movie $movie)
	{
		$sql = "
			INSERT INTO movie
				(category_id, title, price, amount)
			VALUES (:categoryId, :title, :price, :amount)
		";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':categoryId', $movie->getCategoryId(), \PDO::PARAM_INT);
		$stmt->bindValue(':title', $movie->getTitle());
		$stmt->bindValue(':price', $movie->getPrice());
		$stmt->bindValue(':amount', $movie->getAmount(), \PDO::PARAM_INT);
		$stmt->execute();

		$movie->setId($this->conn->lastInsertId());
	}

	/**
	 * Update a record
	 *
	 * @param \Lcvs\Entity\Movie $movie
	 */
	public function update(\Lcvs\Entity\Movie $movie)
	{
		$sql = "
			UPDATE movie
			SET category_id = :categoryId,
				title = :title,
				price = :price,
				amount = :amount
			WHERE
				id = :id
		";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':categoryId', $movie->getCategoryId(), \PDO::PARAM_INT);
		$stmt->bindValue(':title', $movie->getTitle());
		$stmt->bindValue(':price', $movie->getPrice());
		$stmt->bindValue(':amount', $movie->getAmount(), \PDO::PARAM_INT);
		$stmt->bindValue(':id', $movie->getId(), \PDO::PARAM_INT);
		$stmt->execute();
	}

	/**
	 * Delete a movie
	 *
	 * @param \Lcvs\Entity\Movie $movie
	 * @return bool
	 */
	public function delete(\Lcvs\Entity\Movie $movie)
	{
		$sql = "
			DELETE FROM movie
			WHERE id = :id
		";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(':id', $movie->getId());

		return $stmt->execute();
	}

	/**
	 * Search for movies
	 *
	 * @param array $search
	 * @return \Lcvs\Entity\Movie[]
	 */
	public function search($search)
	{
		if (empty($search)) {
			return null;
		}

		$sql = "
			SELECT
				m.id,
				m.category_id AS categoryId,
				m.price,
				m.amount,
				m.title
			FROM movie m
			LEFT JOIN category c ON c.id = m.category_id
			WHERE 1 = 1
		";
		$params = array();
		if (array_key_exists('categoryTitle', $search)) {
			$sql .= " AND c.title = :categoryTitle";
			$params[':categoryTitle'] = $search['categoryTitle'];
		}
		if (array_key_exists('movieTitle', $search)) {
			$sql .= " AND m.title LIKE :movieTitle";
			$params[':movieTitle'] = '%'.$search['movieTitle'].'%';
		}

		$stmt = $this->conn->prepare($sql);
		$stmt->execute($params);

		return $stmt->fetchAll(\PDO::FETCH_OBJ);
	}
}