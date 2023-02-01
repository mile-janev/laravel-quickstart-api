<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function viewAny(?User $user)//Added questionmark so the model is optional
	{
		return true;//Just for testing, returning true always
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\Role  $role
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function view(?User $user, Role $role)//Added questionmark so the model is optional
	{
		return true;//Just for testing, returning true always
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function create(?User $user)
	{
		return true;//Just for testing, returning true always
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\Role  $role
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function update(User $user, Role $role)
	{
		//
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\Role  $role
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function delete(User $user, Role $role)
	{
		//
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\Role  $role
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function restore(User $user, Role $role)
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\Role  $role
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function forceDelete(User $user, Role $role)
	{
		//
	}

	/**
	 * Determine whether the user can view the post's tags.
	 *
	 * @param  \App\Models\User|null  $user
	 * @param  \App\Models\Role  $role
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function viewUsers(?User $user, Role $role)
	{
		return $this->view($user, $role);
	}
}
