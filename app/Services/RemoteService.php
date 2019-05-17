<?php

namespace App\Services;

use Exception;

class RemoteService
{
	public function __construct()
	{
		// ...
	}

	public function createNewRecord(array $data)
	{
		if(!rand(0, 1)) {
			throw new Exception("Can't save data");
		} else {
			return json_decode(json_encode($data));
		}
	}
}