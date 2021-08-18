<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function register(UserStoreRequest $request): JsonResponse
    {
        $user = User::create($request->validated());
        return response()->json([
            'status' => true,
            'code' => Response::HTTP_CREATED,
            'message' => 'Welcome new user, successful registration',
            'token_type' => 'Bearer',
            '_token' => $user->createToken('Personal Access Token')->accessToken,
        ], Response::HTTP_CREATED);
    }
}
