<?php

namespace Lcvs\Controller;

use Fw\Core\BaseController;
use Fw\Core\Request;
use Fw\Core\Response;
use Lcvs\Factory;

class User extends BaseController
{
	/**
	 * Delete a user
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function executeDelete(Request $request)
	{
		try {
			$this->checkAdmin();
			Factory::create()->createUserManager()->delete($request->getParameter('id'));
			return new Response(array('success' => true));
		} catch (\Exception $e) {
			return new Response(array(
				'success' => false,
				'error'   => $e->getMessage(),
			), $e->getCode());
		}
	}

	/**
	 * Create a user
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function executeCreate(Request $request)
	{
		try {
			$this->checkAdmin();
			Factory::create()->createUserManager()->insert($request->getParameters());
			return new Response(array('success' => true));
		} catch (\Exception $e) {
			return new Response(array(
				'success' => false,
				'error'   => $e->getMessage(),
			), $e->getCode());
		}
	}

	/**
	 * Update a user
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function executeUpdate(Request $request)
	{
		try {
			$this->checkAdmin();
			Factory::create()->createUserManager()->update($request->getParameters());
			return new Response(array('success' => true));
		} catch (\Exception $e) {
			return new Response(array(
				'success' => false,
				'error'   => $e->getMessage(),
			), $e->getCode());
		}
	}
}