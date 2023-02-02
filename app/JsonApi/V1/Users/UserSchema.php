<?php

declare(strict_types=1);

namespace App\JsonApi\V1\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields\DateTime;
use LaravelJsonApi\Eloquent\Fields\ID;
use LaravelJsonApi\Eloquent\Fields\Str;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Filters\WhereIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsToMany;

class UserSchema extends Schema
{
	/**
	 * The model the schema corresponds to.
	 *
	 * @var string
	 */
	public static string $model = User::class;

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
			Str::make('email'),
			Str::make('password'),
			Str::make('password_confirmation'),
			BelongsToMany::make('roles'),
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

	/**
	 * Build an index query for this resource.
	 *
	 * @param Request|null $request
	 * @param Builder $query
	 * @return Builder
	 */
	public function indexQuery(?Request $request, Builder $query): Builder
	{
	   /*if ($user = optional($request)->user()) {
			return $query->where(function (Builder $q) use ($user) {
				return $q->whereNotNull('published_at')->orWhere('author_id', $user->getKey());
			});
		}*/

		return $query->whereNotNull('remember_token');
	}
}
