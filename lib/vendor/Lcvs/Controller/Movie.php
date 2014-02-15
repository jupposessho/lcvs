<?php

namespace Lcvs\Controller;

use Fw\Core\BaseController;
use Fw\Core\Request;
use Fw\Core\Response;
use Lcvs\Factory;

class Movie extends BaseController
{
	/**
	 * Delete a movie
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function executeDelete(Request $request)
	{
		try {
			Factory::create()->createMovieManager()->delete($request->getParameter('id'));
			return new Response(array('success' => true));
		} catch (\Exception $e) {
			return new Response(array(
				'success' => false,
				'error'   => $e->getMessage(),
			));
		}
	}

	/**
	 * Create a movie
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function executeCreate(Request $request)
	{
		try {
			Factory::create()->createMovieManager()->insert($request->getParameters());
			return new Response(array('success' => true));
		} catch (\Exception $e) {
			return new Response(array(
				'success' => false,
				'error'   => $e->getMessage(),
			));
		}
	}

	/**
	 * Update a movie
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function executeUpdate(Request $request)
	{
		try {
			Factory::create()->createMovieManager()->update($request->getParameters());
			return new Response(array('success' => true));
		} catch (\Exception $e) {
			return new Response(array(
				'success' => false,
				'error'   => $e->getMessage(),
			));
		}
	}

	/**
	 * Search for movie
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function executeSearch(Request $request)
	{
		try {
			$movies = Factory::create()->createMovieManager()->search($request->getParameters());
			return new Response(array(
				'success' => true,
				'movies'  => $movies,
			));
		} catch (\Exception $e) {
			return new Response(array(
				'success' => false,
				'error'   => $e->getMessage(),
			));
		}
	}
}