<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
	/**
	 * @OA\Get(
	 *     path="/",
	 *     description="Test page",
	 *     @OA\Response(response="default", description="Test page")
	 * )
	 */
	public function test()
	{
	}
}
