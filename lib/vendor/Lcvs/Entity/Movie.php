<?php
namespace Lcvs\Entity;

/**
 * Class Movie
 * @package Lcvs\Entity
 */
class Movie
{
	/** @var int */
	private $id;

	/** @var int */
	private $categoryId;

	/** @var string */
	private $title;

	/** @var double */
	private $price;

	/** @var int */
	private $amount;

	/**
	 * @param int $amount
	 */
	public function setAmount($amount)
	{
		$this->amount = $amount;
	}

	/**
	 * @return int
	 */
	public function getAmount()
	{
		return $this->amount;
	}

	/**
	 * @param int $categoryId
	 */
	public function setCategoryId($categoryId)
	{
		$this->categoryId = $categoryId;
	}

	/**
	 * @return int
	 */
	public function getCategoryId()
	{
		return $this->categoryId;
	}

	/**
	 * @param float $price
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}

	/**
	 * @return float
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
}