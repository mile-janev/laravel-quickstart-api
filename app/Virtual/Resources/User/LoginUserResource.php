<?php

namespace App\Virtual\Resources\User;

/**
 *  @OA\Schema(
 *      title="LoginUserResource",
 *      description="Login User Resource",
 *      @OA\Xml(
 *          name="LoginUserResource"
 *      )
 *  )
 */
class LoginUserResource
{
	/**
	 *  @OA\Property(
	 *      title="Token",
	 *      description="Token",
	 *      example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMDgyNTUwZWI1NzVjM2Y1NWI4MDY1Yjc2ZDJiMWQxNWYxOWIwOTNmMmViOWRkY2E0YmNlN2NhNzFjNDNlYmE1ODQ3Y2VlMzczYzkyZTA2ZjgiLCJpYXQiOjE2NjU3NTIxOTIuNjQyNzQxLCJuYmYiOjE2NjU3NTIxOTIuNjQyNzQ0LCJleHAiOjE2OTcyODgxOTIuNjEyOTc4LCJzdWIiOiI1Iiwic2NvcGVzIjpbXX0.",
	 *  )
	 *
	 * @var string
	 */
	private $token; //@phpstan-ignore-line

	/**
	 *  @OA\Property(
	 *      title="Data",
	 *      description="Data wrapper"
	 *  )
	 *
	 * @var \App\Virtual\Models\User
	 */
	private $user; //@phpstan-ignore-line

	/**
	 *  @OA\Property(
	 *      title="Message",
	 *      description="Message",
	 *      example="Some message",
	 *  )
	 *
	 * @var string
	 */
	private $message; //@phpstan-ignore-line
}
