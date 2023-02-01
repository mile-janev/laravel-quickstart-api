<?php

declare(strict_types=1);

namespace App\JsonApi\V1\Roles;

use App\Models\Role;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsToMany;

class RoleSchema extends Schema
{
	/**
	 * The model the schema corresponds to.
	 *
	 * @var string
	 */
	public static string $model = Role::class;

	/**
	 * The maximum include path depth.
	 *
	 * @var int
	 */
	protected int $maxDepth = 3;

	/**
	 * Get the resource fields.
	 *
	 * @return array
	 */
	public function fields(): array
	{
		return [
			ID::make(),
			Str::make('name'),
			Str::make('description'),
			BelongsToMany::make('users'),
			DateTime::make('createdAt')->sortable()->readOnly(),
			DateTime::make('updatedAt')->sortable()->readOnly(),
		];
	}

	/**
	 * Get the resource filters.
	 *
	 * @return array
	 */
	public function filters(): array
	{
		return [
			WhereIdIn::make($this),
		];
	}

	/**
	 * Get the resource paginator.
	 *
	 * @return Paginator|null
	 */
	public function pagination(): ?Paginator
	{
		return PagePagination::make();
	}
}