<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	private UserRepositoryInterface $userRepository;

	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 *  @OA\Post(
	 *      path="/api/register",
	 *      description="Returns user data",
	 *      tags={"User"},
	 *      summary="POST register user",
	 *      operationId="RegisterUser",
	 *      @OA\RequestBody(
	 *          required=true,
	 *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
	 *      ),
	 *      @OA\Response(
	 *          response=201,
	 *          description="Successful created",
	 *          @OA\JsonContent(ref="#/components/schemas/RegisterUserResource")
	 *      ),
	 *      @OA\Response(
	 *          response=400,
	 *          description="Bad Request"
	 *      ),
	 *      @OA\Response(
	 *          response=401,
	 *          description="Unauthenticated",
	 *      ),
	 *      @OA\Response(
	 *          response=403,
	 *          description="Forbidden"
	 *      ),
	 *      @OA\Response(
	 *          response=404,
	 *          description="Resource Not Found"
	 *      ),
	 *      @OA\Response(
	 *          response=422,
	 *          description="Unprocessable Content"
	 *      ),
	 *  )
	 */
	public function register(RegisterRequest $request)
	{
		$user = $this->userRepository->registerUser($request);

		return response()->json([
				'user' => new UserResource($user),
				'message' => __('messages.register_success'),
			], 201);
	}

	/**
	 *  @OA\Post(
	 *      path="/api/login",
	 *      description="Returns user data",
	 *      tags={"User"},
	 *      summary="POST Login user",
	 *      operationId="LoginUser",
	 *      @OA\RequestBody(
	 *          required=true,
	 *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
	 *      ),
	*       @OA\Response(
	 *          response=200,
	 *          description="OK",
	 *          @OA\JsonContent(ref="#/components/schemas/LoginUserResource")
	 *      ),
	 *      @OA\Response(
	 *          response=400,
	 *          description="Bad Request"
	 *      ),
	 *      @OA\Response(
	 *          response=401,
	 *          description="Unauthenticated",
	 *      ),
	 *      @OA\Response(
	 *          response=403,
	 *          description="Forbidden"
	 *      ),
	 *      @OA\Response(
	 *          response=404,
	 *          description="Resource Not Found"
	 *      ),
	 *  )
	 */
	public function login(LoginRequest $request)
	{
		if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
			$user = Auth::user();

			$accessToken = $user->createToken('authToken')->accessToken;

			return response()->json([
				'token' => $accessToken,
				'user' => new UserResource($user),
				'message' => __('messages.login_success')
			], 200);
		} else {
			return response()->json([
				'error' => __('messages.unauthorized')
			], 401);
		}
	}
}
