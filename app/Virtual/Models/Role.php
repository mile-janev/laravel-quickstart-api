<?php

declare(strict_types=1);

namespace App\Virtual\Models;

/**
 *  @OA\Schema(
 *      title="Role",
 *      description="Role model",
 *      @OA\Xml(
 *          name="Role"
 *      )
 *  )
 */
class Role
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
	 *      example="admin"
	 *  )
	 *
	 * @var string
	 */
	public $name;

	/**
	 *  @OA\Property(
	 *      title="Description",
	 *      description="Description",
	 *      example="Administrator"
	 *  )
	 *
	 * @var string
	 */
	public $description;

	/**
	 *  @OA\Property(
	 *      title="Users",
	 *      description="Users",
	 *      @OA\Items,
	 *      example={
	 *          {
	 *              "id": 2,
	 *              "name": "User",
	 *              "email": "testuser1@example.com",
	 *              "email_verified_at": null,
	 *              "created_at": "2023-01-30T15:06:45.000000Z",
	 *              "updated_at": "2023-01-30T15:06:45.000000Z",
	 *              "deleted_at": null
	 *          },
	 *          {
	 *              "id": 3,
	 *              "name": "User Two",
	 *              "email": "testuser2@example.com",
	 *              "email_verified_at": null,
	 *              "created_at": "2023-01-30T15:55:40.000000Z",
	 *              "updated_at": "2023-01-30T15:55:40.000000Z",
	 *              "deleted_at": null
	 *          }
	 *      }
	 *  )
	 *
	 * @var array
	 */
	public $roles;
}
