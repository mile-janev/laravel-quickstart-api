<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;

class RoleController extends Controller
{
	/**
	 * @OA\Get(
	 *     path="/api/v1/roles",
	 *     description="Roles",
	 *     tags={"User"},
	 *     summary="GET roles",
	 *     operationId="roles",
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
	 *          @OA\JsonContent(ref="#/components/schemas/Role")
	 *     ),
	 *      @OA\Response(
	 *          response=401,
	 *          description="Unauthenticated."
	 *      )
	 * )
	 *
	 */
	public function index()
	{
		$roles = Role::all();

		$data = RoleResource::collection($roles);

		return response()->json($data, 200);
	}
}
