<?php

declare(strict_types=1);

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
	private $id;

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

	/**
	 *  @OA\Property(
	 *      title="Roles",
	 *      description="Roles",
	 *      @OA\Items,
	 *      example={
	 *          "id": 1,
	 *          "name": "admin",
	 *          "description": "Administrator"
	 *      }
	 *  )
	 *
	 * @var array
	 */
	public $roles;
}
