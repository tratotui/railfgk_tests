<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
	const VIEW_PATH = '';

	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	protected function showView($action, $data = [])
	{
		return view(
			static::VIEW_PATH . '.' . $action,
			$data
		);
	}

	protected function returnResult($result)
	{
		return !$this->request->ajax() ?
                redirect(static::VIEW_PATH) :
                $result;
	}
}