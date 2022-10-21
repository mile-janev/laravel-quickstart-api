<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Register User Request",
 *      description="Register User request body data",
 *      type="object"
 * )
 */

class RegisterRequest
{
	/**
	 * @OA\Property(
	 *      title="Name",
	 *      description="Name",
	 *      example="John Doe"
	 * )
	 *
	 * @var string
	 */
	public $name;

	/**
	 * @OA\Property(
	 *      title="Email",
	 *      description="Email Address",
	 *      example="john@doe.com"
	 * )
	 *
	 * @var string
	 */
	public $email;

	/**
	 * @OA\Property(
	 *      title="Password",
	 *      description="Password must be at least 8 characters long and contain a mix of letters and numbers.",
	 *      example="userPassword123!",
	 * )
	 *
	 * @var string
	 */
	public $password;
}
