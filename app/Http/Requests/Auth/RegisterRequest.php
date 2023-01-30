<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;

class RegisterRequest extends ApiRequest
{
	 /**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name'      => 'required|string|max:255',
			'email'     => 'required|string|email|max:255|unique:users',
			'password'  => ['required', 'string', 'min:8', 'max:100']
		];
	}
}
