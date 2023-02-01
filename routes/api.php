<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;

JsonApiRoute::server('v1')->prefix('v1')->resources(function ($server) {
	$server->resource('users', JsonApiController::class)
		->relationships(function($relations){
			$relations->hasMany('roles')->readOnly();
		});

	$server->resource('roles', JsonApiController::class)
		//->readOnly()
		->relationships(function($relations){
			$relations->hasMany('users')->readOnly();
		});
});
