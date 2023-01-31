<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

class AuthController extends Controller
{
	private UserRepositoryInterface $userRepository;

	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 *  @OA\Post(
	 *      path="/api/v1/user/register",
	 *      description="Returns user data",
	 *      tags={"Auth"},
	 *      summary="POST register user",
	 *      operationId="RegisterUser",
	 *      @OA\Parameter(
	 *          in="header",
	 *          name="Accept-Language",
	 *          @OA\Schema(
	 *              type="string",
	 *              enum={"en-EN", "mk"},
	 *              default="en-EN"
	 *          ),
	 *      ),
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
	 *      path="/api/v1/user/login",
	 *      description="Returns user data",
	 *      tags={"Auth"},
	 *      summary="POST Login user",
	 *      operationId="LoginUser",
	 *      @OA\Parameter(
	 *          in="header",
	 *          name="Accept-Language",
	 *          @OA\Schema(
	 *              type="string",
	 *              enum={"en-EN", "mk"},
	 *              default="en-EN"
	 *          ),
	 *      ),
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

	/**
	 * @OA\Post(
	 *     path="/api/v1/user/logout",
	 *     description="Logout user",
	 *     tags={"Auth"},
	 *     summary="POST Logout user",
	 *     operationId="Logout",
	 *     security={ {"bearerAuth": {} }},
	 *     @OA\Parameter(
	 *          in="header",
	 *          name="Accept-Language",
	 *          @OA\Schema(
	 *              type="string",
	 *              enum={"en-EN", "mk"},
	 *              default="en-EN"
	 *          ),
	 *     ),
	 *     @OA\Response(
	 *          response=200,
	 *          description="You have succesfully logged out",
	 *          @OA\JsonContent(type="object")
	 *      ),
	 *      @OA\Response(
	 *          response=401,
	 *          description="Unauthenticated."
	 *      )
	 * )
	 */
	public function logout(Request $request)
	{
		//$user = Auth::user();
		//$user->token()->revoke();

		app(TokenRepository::class)->revokeAccessToken(Auth::user()->token()->id);

		return response()->json([
			'message' => __('messages.logout_success')
		], 200);
	}

	/**
	 * @OA\Post(
	 *     path="/api/v1/user/logout-all-devices",
	 *     description="Logout user from all devices",
	 *     tags={"Auth"},
	 *     summary="POST Logout user from all devices",
	 *     operationId="LogoutFromAllDevices",
	 *     security={ {"passport": {} }},
	 *     @OA\Parameter(
	 *          in="header",
	 *          name="Accept-Language",
	 *          @OA\Schema(
	 *              type="string",
	 *              enum={"en-EN", "mk"},
	 *              default="en-EN"
	 *          ),
	 *     ),
	 *     @OA\Response(
	 *          response=200,
	 *          description="You have succesfully logged out",
	 *          @OA\JsonContent(type="object")
	 *      ),
	 *      @OA\Response(
	 *          response=401,
	 *          description="Unauthenticated."
	 *      )
	 * )
	 */
	public function logoutAllDevices(Request $request)
	{
		$tokens = Auth::user()->tokens->pluck('id');
		Token::whereIn('id', $tokens)
			->update(['revoked' => true]);

		RefreshToken::whereIn('access_token_id', $tokens)->update(['revoked' => true]);

		return response()->json([
			'message' => __('messages.logout_success')
		], 200);
	}
}
