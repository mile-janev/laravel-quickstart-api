<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	/**
	 * @OA\Get(
	 *     path="/api/v1/user/profile",
	 *     description="Profile",
	 *     tags={"User"},
	 *     summary="GET user profile",
	 *     operationId="profile",
	 *     security={ {"bearerAuth": {} }},
	 *     @OA\Parameter(
	 *          in="header",
	 *          name="Accept-Language",
	 *          @OA\Schema(
	 *              type="string",
	 *              enum={"en-EN", "mk"},
	 *              default="en-EN"
	 *          ),
	 *     ),
	 *     @OA\Response(
	 *          response=200,
	 *          description="Successful operation",
	 *          @OA\JsonContent(ref="#/components/schemas/User")
	 *     ),
	 *      @OA\Response(
	 *          response=401,
	 *          description="Unauthenticated."
	 *      )
	 * )
	 *
	 */
	public function profile()
	{
		$user = Auth::user();

		$data = new UserResource($user);

		return response()->json($data, 200);
	}
}
