<?php

namespace App\JsonApi\V1\Roles;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class RoleRequest extends ResourceRequest
{
	/**
	 * Get the validation rules for the resource.
	 *
	 * @return array
	 */
	public function rules(): array
	{
		return [
			'name'      => ['required', 'string', 'max:255'],
			'description'     => ['required', 'string', 'max:255'],
			'users' => JsonApiRule::toMany(),
		];
	}
}
