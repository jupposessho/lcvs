<?php
namespace Lcvs\Config;

class Routing
{
	/**
	 * Get application routing
	 *
	 * @return array
	 */
	public static function get()
	{
		return array(
			'Lcvs/Movie/Create' => array('url' => "/movie/", 'method' => 'POST', 'credential' => 'admin'),
			'Lcvs/Movie/Update' => array('url' => "/movie/(?'id'\d+)", 'method' => 'PUT', 'credential' => 'admin'),
			'Lcvs/Movie/Delete' => array('url' => "/movie/(?'id'\d+)", 'method' => 'DELETE', 'credential' => 'admin'),
			'Lcvs/Movie/Search' => array('url' => "/movie(?'queryString'[^/]+)", 'method' => 'GET'),
			'Lcvs/User/Create'  => array('url' => "/user/", 'method' => 'POST', 'credential' => 'admin'),
			'Lcvs/User/Update'  => array('url' => "/user/(?'id'\d+)", 'method' => 'PUT', 'credential' => 'admin'),
			'Lcvs/User/Delete'  => array('url' => "/user/(?'id'\d+)", 'method' => 'DELETE', 'credential' => 'admin'),
			'Lcvs/Hire/List'    => array('url' => "/hire", 'method' => 'GET', 'credential' => 'admin'),
		);
	}
}
