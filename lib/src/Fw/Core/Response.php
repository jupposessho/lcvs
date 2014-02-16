<?php
namespace Fw\Core;

/**
 * Class Response
 * @package Fw\Core
 */
class Response
{
	/**
	 * @var array
	 */
	public $headers;

	/**
	 * @var string
	 */
	protected $content;

	/**
	 * @var integer
	 */
	protected $statusCode;

	/**
	 * @var string
	 */
	protected $statusText;

	/**
	 * @var
	 */
	protected $data;

	/**
	 * Constructor.
	 *
	 * @param mixed   $data    The response data
	 * @param integer $status  The response status code
	 * @param array   $headers An array of response headers
	 */
	public function __construct($data = null, $status = 200, $headers = array())
	{
		$this->headers = $headers;
		$this->setStatusCode($status);
		if (!array_key_exists('Date', $this->headers)) {
			$date = new \DateTime(null, new \DateTimeZone('UTC'));
			$this->headers['Date'] = $date->format('D, d M Y H:i:s').' GMT';
		}

		if (null === $data) {
			$data = new \ArrayObject();
		}
		$this->setData($data);
	}

	/**
	 * Creates an instance
	 *
	 * @param mixed   $data    The response data
	 * @param integer $status  The response status code
	 * @param array   $headers An array of response headers
	 * @return Response
	 */
	public static function create($data = null, $status = 200, $headers = array())
	{
		return new static($data, $status, $headers);
	}

	/**
	 * Sets the data to be sent as json
	 *
	 * @param mixed $data
	 *
	 * @return Response
	 */
	public function setData($data = array())
	{
		$this->data = json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);

		$this->headers['Content-Type'] = 'application/json';

		return $this->content = $this->data;
	}

	/**
	 * Returns the Response as an HTTP string
	 *
	 * @return string The Response as an HTTP string
	 */
	public function __toString()
	{
		return
			sprintf('HTTP/%s %s %s', '1.1', $this->statusCode, $this->statusText)."\r\n".
			$this->getHeaders()."\r\n".
			$this->content;
	}

	/**
	 * Sets the response status code.
	 *
	 * @param integer $code HTTP status code
	 * @throws \InvalidArgumentException When the HTTP status code is not valid
	 * @return Response
	 */
	public function setStatusCode($code)
	{
		if (false === filter_var($code, FILTER_VALIDATE_INT, array(
			'default'   => 500,
			'min_range' => 100,
			'max_range' => 600,
		))) {
			throw new \InvalidArgumentException(sprintf('The HTTP status code "%s" is not valid.', $code));
		}

		$usedCodes = array(200, 201, 204, 401, 403, 404);
		$this->statusCode = in_array($code, $usedCodes) ? (int) $code : 500;

		return $this;
	}

	/**
	 * Sends HTTP headers
	 *
	 * @return Response
	 */
	public function sendHeaders()
	{
		// headers have already been sent by the developer
		if (headers_sent()) {
			return $this;
		}

		// status
		header(sprintf('HTTP/%s %s %s', '1.1', $this->statusCode, $this->statusText), true, $this->statusCode);

		// headers
		foreach ($this->headers as $name => $value) {
			header($name.': '.$value, false, $this->statusCode);
		}

		return $this;
	}

	/**
	 * Sends content for the current web response
	 *
	 * @return Response
	 */
	public function sendContent()
	{
		echo $this->content;

		return $this;
	}

	/**
	 * Sends HTTP headers and content
	 *
	 * @return Response
	 */
	public function send()
	{
		$this->sendHeaders();
		$this->sendContent();

		return $this;
	}

	/**
	 * Get headers as string
	 *
	 * @return string
	 */
	private function getHeaders()
	{
		return implode(', ', $this->headers);
	}
}