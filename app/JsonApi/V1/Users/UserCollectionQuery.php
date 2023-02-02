<?php

namespace App\JsonApi\V1\Users;

use LaravelJsonApi\Laravel\Http\Requests\ResourceQuery;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class UserCollectionQuery extends ResourceQuery
{
	/**
	 * Get the validation rules that apply to the request query parameters.
	 *
	 * @return array
	 */
	public function rules(): array
	{
		return [
			'fields' => [
				'nullable',
				'array',
				JsonApiRule::fieldSets(),
			],
			'filter' => [
				'nullable',
				'array',
				JsonApiRule::filter(),
			],
			'filter.id' => 'array',
			'filter.id.*' => 'integer',
			'include' => [
				'nullable',
				'string',
				JsonApiRule::includePaths(),
			],
			'page' => [
				'nullable',
				'array',
				JsonApiRule::page(),
			],
			'page.number' => ['integer', 'min:1'],
			'page.size' => ['integer', 'between:1,100'],
			'sort' => [
				'nullable',
				'string',
				JsonApiRule::sort(),
			],
			'withCount' => [
				'nullable',
				'string',
				JsonApiRule::countable(),
			],
		];
	}
}
