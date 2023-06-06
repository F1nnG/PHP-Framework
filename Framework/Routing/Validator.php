<?php

namespace Framework\Routing;

use Framework\EdgeHandling\Error;

class Validator
{
	private $request;
	private $rules;

	public function __construct(array $request, array $rules)
	{
		$this->request = $request;
		$this->rules = $rules;
	}

	public function validate()
	{
		foreach ($this->rules as $key => $rule) {
			$rules = explode('|', $rule);

			foreach ($rules as $rule) {
				$rule = explode(':', $rule);

				if (count($rule) > 1) {
					$method = $rule[0];
					$param = $rule[1];
				} else {
					$method = $rule[0];
					$param = null;
				}

				if (method_exists($this, $method))
					$this->$method($key, $param);
			}
		}
	}

	private function accepted(string $key, string|null $param): void
	{
		$accepted = ['on', 'yes', '1', 1, true, 'true'];
		if (!in_array($this->request[$key], $accepted, true))
			throw new Error(403, 'The ' . $key . ' must be accepted.');
	}

	private function active_url(string $key, string|null $param): void
	{
		if (!filter_var($this->request[$key], FILTER_VALIDATE_URL))
			throw new Error(403, 'The ' . $key . ' is not a valid URL.');
	}

	private function array(string $key, string|null $param): void
	{
		if (!is_array($this->request[$key]))
			throw new Error(403, 'The ' . $key . ' must be an array.');
	}

	private function boolean(string $key, string|null $param): void
	{
		$booleans = ['true', 'false', '1', '0', 1, 0, true, false];
		if (!in_array($this->request[$key], $booleans, true))
			throw new Error(403, 'The ' . $key . ' must be a boolean.');
	}

	private function date(string $key, string|null $param): void
	{
		if (!strtotime($this->request[$key]))
			throw new Error(403, 'The ' . $key . ' is not a valid date.');
	}

	private function decimal(string $key, string|null $param): void
	{
		if (!is_float($this->request[$key]))
			throw new Error(403, 'The ' . $key . ' must be a decimal.');

		$decimal = explode(',', $param);

		if (count($decimal) > 2)
			throw new Error(403, 'The ' . $key . ' decimal rule is invalid.');

		$decimalCount = strlen($this->request[$key]) - strrpos($this->request[$key], '.') - 1;
		if (count($decimal) === 1) {
			if (!($decimalCount == $decimal[0]))
				throw new Error(403, 'The ' . $key . ' must be ' . $decimal[0] . ' digits.');
		} else {
			if (!($decimalCount >= $decimal[0] && $decimalCount <= $decimal[1]))
				throw new Error(403, 'The ' . $key . ' must be between ' . $decimal[0] . ' and ' . $decimal[1] . ' digits.');
		}
	}

	private function declined(string $key, string|null $param): void
	{
		$declined = ['off', 'no', '0', 0, false, 'false'];
		if (!in_array($this->request[$key], $declined, true))
			throw new Error(403, 'The ' . $key . ' must be declined.');
	}

	private function different(string $key, string|null $param): void
	{
		if ($this->request[$key] === $this->request[$param])
			throw new Error(403, 'The ' . $key . ' and ' . $param . ' must be different.');
	}

	private function email(string $key, string|null $param): void
	{
		if (!filter_var($this->request[$key], FILTER_VALIDATE_EMAIL))
			throw new Error(403, 'The ' . $key . ' must be a valid email address.');
	}

	private function file(string $key, string|null $param): void
	{
		if (!is_file($this->request[$key]))
			throw new Error(403, 'The ' . $key . ' must be a file.');
	}

	private function integer(string $key, string|null $param): void
	{
		if (!is_int($this->request[$key]))
			throw new Error(403, 'The ' . $key . ' must be an integer.');
	}

	private function ip(string $key, string|null $param): void
	{
		if (!filter_var($this->request[$key], FILTER_VALIDATE_IP))
			throw new Error(403, 'The ' . $key . ' must be a valid IP address.');
	}

	private function ipv4(string $key, string|null $param): void
	{
		if (!filter_var($this->request[$key], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
			throw new Error(403, 'The ' . $key . ' must be a valid IPv4 address.');
	}

	private function ipv6(string $key, string|null $param): void
	{
		if (!filter_var($this->request[$key], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
			throw new Error(403, 'The ' . $key . ' must be a valid IPv6 address.');
	}

	private function json(string $key, string|null $param): void
	{
		if (!is_array(json_decode($this->request[$key], true)))
			throw new Error(403, 'The ' . $key . ' must be a valid JSON string.');
	}

	private function lowercase(string $key, string|null $param): void
	{
		if (strtolower($this->request[$key]) !== $this->request[$key])
			throw new Error(403, 'The ' . $key . ' must be lowercase.');
	}

	private function mac_address(string $key, string|null $param): void
	{
		if (!filter_var($this->request[$key], FILTER_VALIDATE_MAC))
			throw new Error(403, 'The ' . $key . ' must be a valid MAC address.');
	}

	private function numeric(string $key, string|null $param): void
	{
		if (!is_numeric($this->request[$key]))
			throw new Error(403, 'The ' . $key . ' must be numeric.');
	}

	private function required(string $key, string|null $param): void
	{
		if (!array_key_exists($key, $this->request))
			throw new Error(403, 'The ' . $key . ' field is required.');
	}

	private function string(string $key, string|null $param): void
	{
		if (!is_string($this->request[$key]))
			throw new Error(403, 'The ' . $key . ' must be a string.');
	}

	private function uppercase(string $key, string|null $param): void
	{
		if (strtoupper($this->request[$key]) !== $this->request[$key])
			throw new Error(403, 'The ' . $key . ' must be uppercase.');
	}

	private function url(string $key, string|null $param): void
	{
		if (!filter_var($this->request[$key], FILTER_VALIDATE_URL))
			throw new Error(403, 'The ' . $key . ' must be a valid URL.');
	}

	private function ulid(string $key, string|null $param): void
	{
		if (!preg_match('/^[0-9A-Z]{26}$/', $this->request[$key]))
			throw new Error(403, 'The ' . $key . ' must be a valid ULID.');
	}
}