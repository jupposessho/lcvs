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
			'Lcvs/Movie/Create' => array('url' => "/movie/", 'method' => 'POST'),
			'Lcvs/Movie/Update' => array('url' => "/movie/(?'id'\d+)", 'method' => 'PUT'),
			'Lcvs/Movie/Delete' => array('url' => "/movie/(?'id'\d+)", 'method' => 'DELETE'),
			'Lcvs/Movie/Search' => array('url' => "/movie(?'queryString'[^/]+)", 'method' => 'GET'),
		);
	}
}
