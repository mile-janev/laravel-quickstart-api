<?php

declare(strict_types=1);

namespace App\JsonApi\V1\Users;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class UserRequest extends ResourceRequest
{
	/**
	 * Get the validation rules for the resource.
	 *
	 * @return array
	 */
	public function rules(): array
	{
		$model = $this->model();

		$rules = [
			'name'      => ['required', 'string', 'max:255'],
			'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
			'password' => $model ? ['filled'] : ['required', 'confirmed', 'min:8'],
			'roles' => JsonApiRule::toMany(),
		];

		return $rules;
	}
}
