<?php
namespace Fw\Core;
use Fw\Core\Exception\Authentication;
use Lcvs\Entity\User;
use Lcvs\Factory;

/**
 * Class BaseController
 * @package Fw\Core
 */
class BaseController
{
	/** @var string */
	protected $moduleName;

	/** @var string */
	protected $actionName;

	/** @var User */
	protected $user;

	/**
	 * Construct method
	 *
	 * @param string $moduleName
	 * @param string $actionName
	 */
	public function  __construct($moduleName, $actionName)
	{
		$this->moduleName   = $moduleName;
		$this->actionName   = $actionName;
	}

	/**
	 * Redirects to specified url
	 *
	 * @param string $url
	 */
	public function redirect($url)
	{
		header("307 Temporary Redirect HTTP/1.1");
		header('location: ' . $url);
		exit;
	}

	/**
	 * Authenticate the user from request
	 *
	 * @param Request $request
	 * @throws Exception\Authentication
	 */
	public function authenticate(Request $request)
	{
		if (!$request->hasParameter('authUser') || !$request->hasParameter('authPass')) {
			throw new Authentication('Username and password required', 401);
		}

		$user = Factory::create()->createUserManager()->getByEmail($request->getParameter('authUser'));
		if (!$user || !$user->checkPassword($request->getParameter('authPass'))) {
			throw new Authentication('Invalid Username/password', 401);
		}

		$this->user = $user;
	}

	/**
	 * Has admin credential - logged in user
	 *
	 * @return bool
	 */
	protected function hasAdminCredential()
	{
		return $this->user->getIsAdmin();
	}

	/**
	 * Check if the logged in user is admin
	 *
	 * @throws Exception\Authentication
	 */
	protected function checkAdmin()
	{
		if (!$this->hasAdminCredential()) {
			throw new Authentication('Admin credential required', 403);
		}
	}
}