<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function register(UserStoreRequest $request): JsonResponse
    {

        $requestData = $request->all();
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

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)){
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        return response()->json([
            'token_type' => 'Bearer',
            'access_token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }
}
