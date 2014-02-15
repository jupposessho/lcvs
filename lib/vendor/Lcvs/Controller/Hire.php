<?php
namespace Lcvs\Controller;

use Fw\Core\BaseController;
use Fw\Core\Request;
use Fw\Core\Response;
use Lcvs\Factory;

/**
 * Class Hire
 * @package Lcvs\Controller
 */
class Hire extends BaseController
{
	/**
	 * List hires
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function executeList(Request $request)
	{
		try {
			$hires = Factory::create()->createHireManager()->getHired();
			return new Response(array(
				'success' => true,
				'hires'   => $hires,
			));
		} catch (\Exception $e) {
			return new Response(array(
				'success' => false,
				'error'   => $e->getMessage(),
			));
		}
	}
} 