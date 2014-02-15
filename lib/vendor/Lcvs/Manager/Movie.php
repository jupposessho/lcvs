<?php
namespace Lcvs\Manager;
use Fw\Core\Exception\NotFound;

/**
 * Class Movie
 * @package Lcvs\Manager
 */
class Movie
{
	/** @var \Lcvs\Dao\Movie */
	private $dao;

	/**
	 * @param \Lcvs\Dao\Movie $dao
	 */
	public function __construct(\Lcvs\Dao\Movie $dao)
	{
		$this->dao = $dao;
	}

	/**
	 * Insert to database
	 *
	 * @param array $data
	 */
	public function insert($data)
	{
		$movie = $this->getMovieFromData($data);
		$this->validate($movie);
		$this->dao->insert($movie);
	}

	/**
	 * Update a movie
	 *
	 * @param array $data
	 */
	public function update($data)
	{
		$movie = $this->getMovieFromData($data);
		$this->validate($movie);
		$this->dao->update($movie);
	}

	/**
	 * Get a movie by id
	 *
	 * @param int $id
	 * @return \Lcvs\Entity\Movie
	 */
	public function get($id)
	{
		return $this->dao->get($id);
	}

	/**
	 * Delete a movie
	 *
	 * @param int $id
	 * @throws \Exception
	 */
	public function delete($id)
	{
		$movie = $this->getMovieFromData(array('id' => $id));
		$result = $this->dao->delete($movie);
		if (!$result) {
			throw new \Exception('Delete failed for movie: ' . $movie->getId());
		}
	}

	/**
	 * Validate movie data
	 *
	 * @param \Lcvs\Entity\Movie $movie
	 * @throws \InvalidArgumentException
	 */
	private function validate(\Lcvs\Entity\Movie $movie)
	{
		if (!is_null($movie->getId()) && false === filter_var($movie->getId(), FILTER_VALIDATE_INT)) {
			throw new \InvalidArgumentException('Id should be an integer');
		}

		if (false === filter_var($movie->getCategoryId(), FILTER_VALIDATE_INT)) {
			throw new \InvalidArgumentException('Category id should be an integer');
		}

		if (false === filter_var($movie->getAmount(), FILTER_VALIDATE_INT)) {
			throw new \InvalidArgumentException('Amount should be an integer');
		}

		if (false === filter_var($movie->getPrice(), FILTER_VALIDATE_FLOAT)) {
			throw new \InvalidArgumentException('Price should be an number');
		}
	}

	/**
	 * Create or modify a movie object from the given array
	 *
	 * @param array $data
	 * @throws \Fw\Core\Exception\NotFound
	 * @return \Lcvs\Entity\Movie
	 */
	private function getMovieFromData($data)
	{
		if (array_key_exists('id', $data)) {
			$movie = $this->get($data['id']);
			if (!$movie) {
				throw new NotFound('Movie not found: ' . $data['id']);
			}
		} else {
			$movie = new \Lcvs\Entity\Movie();
		}

		if (array_key_exists('category_id', $data)) {
			$movie->setCategoryId($data['category_id']);
		}
		if (array_key_exists('title', $data)) {
			$movie->setTitle($data['title']);
		}
		if (array_key_exists('price', $data)) {
			$movie->setPrice($data['price']);
		}
		if (array_key_exists('amount', $data)) {
			$movie->setAmount($data['amount']);
		}

		return $movie;
	}

	/**
	 * Search for movies
	 *
	 * @param array $data
	 * @throws \Exception
	 * @return \Lcvs\Entity\Movie[]
	 */
	public function search($data)
	{
		$search = array();
		if (array_key_exists('category', $data)) {
			$search['categoryTitle'] = $data['category'];
		}

		if (array_key_exists('title', $data)) {
			$search['movieTitle'] = $data['title'];
		}

		if (empty($search)) {
			throw new \Exception('Title or category required');
		}

		return $this->dao->search($search);
	}
}