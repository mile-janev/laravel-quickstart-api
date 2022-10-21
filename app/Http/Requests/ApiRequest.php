<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class ApiRequest extends \Illuminate\Foundation\Http\FormRequest
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

	public function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()
				->json([
					'message' => __('messages.invalid_data'),
					'errors' => $validator->errors()
				], 422));
	}

	public function setValues($model)
	{
		foreach ($this->input() as $key => $value) {
			if (in_array($key, $model->getDates()) && in_array($key, $model->getFillable())) {
				$model->$key = new Carbon($value);
			} elseif (!in_array($key, $model->getDates()) && in_array($key, $model->getFillable())) {
				$model->$key = $value;
			}
		}

		return $model;
	}
}
