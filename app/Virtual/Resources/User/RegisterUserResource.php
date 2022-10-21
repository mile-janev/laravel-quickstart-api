<?php

namespace App\Virtual\Resources\User;

/**
 *  @OA\Schema(
 *      title="RegisterUserResource",
 *      description="Register User Resource",
 *      @OA\Xml(
 *          name="RegisterUserResource"
 *      )
 *  )
 */
class RegisterUserResource
{
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
