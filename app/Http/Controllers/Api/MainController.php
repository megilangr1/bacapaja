<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function check()
		{
			$data = [
				'message' => 'OK'
			];
			return response()->json($data, 200);
		}
}
