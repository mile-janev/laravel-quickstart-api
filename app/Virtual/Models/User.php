<?php

namespace App\Virtual\Models;

/**
 *  @OA\Schema(
 *      title="User",
 *      description="User model",
 *      @OA\Xml(
 *          name="User"
 *      )
 *  )
 */
class User
{
	/**
	 *  @OA\Property(
	 *      title="ID",
	 *      description="ID",
	 *      format="int64",
	 *      example=1
	 *  )
	 *
	 * @var integer
	 */
	private $id; //@phpstan-ignore-line

	/**
	 *  @OA\Property(
	 *      title="Name",
	 *      description="Name",
	 *      example="John Doe"
	 *  )
	 *
	 * @var string
	 */
	public $name;

	/**
	 *  @OA\Property(
	 *      title="Email",
	 *      description="Email",
	 *      example="john@doe.com"
	 *  )
	 *
	 * @var string
	 */
	public $email;
}
