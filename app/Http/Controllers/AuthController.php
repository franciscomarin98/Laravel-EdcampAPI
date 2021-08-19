<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');

            return response()->json([
                'token_type' => 'Bearer',
                'access_token' => $tokenResult->accessToken,
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ]);
        }

        return response()->json([
            'status' => false,
            'code' => Response::HTTP_UNAUTHORIZED,
            'message' => 'Authentication failed due to wrong or unregistered credentials'
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function register(UserStoreRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($requestData['password']);
        $user = User::create($requestData);

        $tokenResult = $user->createToken('Personal Access Token');

        return response()->json([
            'status' => true,
            'code' => Response::HTTP_CREATED,
            'message' => 'Welcome new user, successful registration',
            'token_type' => 'Bearer',
            'access_token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ], Response::HTTP_CREATED);
    }
}
