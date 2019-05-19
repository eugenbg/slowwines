<?php

namespace Stripe\HttpClient;

use Stripe\Stripe;
use Stripe\Error;
use Stripe\Util;

/*
	WPHttpClient
*/
class WPHttpClient implements ClientInterface {
	private static $instance;

	public static function instance() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

    protected $defaultOptions;

	
	public function __construct($defaultHeaders = null) {
		$this->defaultOptions = $defaultHeaders;
	}

	public function getDefaultOptions() {
		return $this->defaultOptions;
	}
	
	const DEFAULT_TIMEOUT = 80;
	const DEFAULT_CONNECT_TIMEOUT = 30;
	
	private $timeout = self::DEFAULT_TIMEOUT;
	private $connectTimeout = self::DEFAULT_CONNECT_TIMEOUT;
	private $http;
	
	public function setTimeout($seconds) {
		$this->timeout = (int) max($seconds, 0);
		return $this;
	}

	public function setConnectTimeout($seconds) {
		$this->connectTimeout = (int) max($seconds, 0);
		return $this;
	}

	public function getTimeout() {
		return $this->timeout;
	}

	public function getConnectTimeout() {
		return $this->connectTimeout;
	}
	
	public function request($method, $absUrl, $headers, $params, $hasFile) {
		
		$method = strtolower($method);
		
		$opts = array();
		if (is_callable($this->defaultOptions)) { // call defaultOptions callback, set options to return value
			$opts = call_user_func_array($this->defaultOptions, func_get_args());
			if (!is_array($opts)) {
				throw new Error\Api("Non-array value returned by defaultOptions WPHttpClient callback");
			}
		} elseif (is_array($this->defaultOptions)) { // set default curlopts from array
			$opts = $this->defaultOptions;
		}
		
		$http = new \WPHttp($absUrl);
		
		$http->SetMethod(strtoupper($method));
		
		switch ($method) {
			case 'get':
				if ($hasFile) {
					throw new Error\Api(
						"Issuing a GET request with a file parameter"
					);
				}
			break;
			
			case 'post':
				
			break;
			
			case 'delete':
			break;
			
			default:
				throw new Error\Api("Unrecognized method {$method}");
			break;
		}
		
		$http->SetBody(self::encode($params));
		$http->SetArg('timeout',$this->timeout);
		
		foreach ($headers as $key => $value) {
			$hdr = explode(':',$value);
			$name = trim(array_shift($hdr));
			$value = trim(implode(':',$hdr));
			$http->SetHeader($name,$value);
		}

		if (!Stripe::$verifySslCerts) {
			$http->SetArg('sslverify',false);
		} else {
			$http->SetArg('sslverify',true);
		}

		$http->Execute();
		if (!$http->LastError()) {
			
			// success
			return array($http->return_body, $http->return_code, $http->return_headers);
			
		} else {
			throw new Error\ApiConnection($http->LastError());
		}
		
	}
	
	public static function encode($arr, $prefix = null)
	{
		if (!is_array($arr)) {
			return $arr;
		}

		$r = array();
		foreach ($arr as $k => $v) {
			if (is_null($v)) {
				continue;
			}

			if ($prefix) {
				if ($k !== null && (!is_int($k) || is_array($v))) {
					$k = $prefix."[".$k."]";
				} else {
					$k = $prefix."[]";
				}
			}

			if (is_array($v)) {
				$enc = self::encode($v, $k);
				if ($enc) {
					$r[] = $enc;
				}
			} else {
				$r[] = urlencode($k)."=".urlencode($v);				
			}
		}
		
		$x = implode("&", $r);
		
		return $x;
	}
}
?>