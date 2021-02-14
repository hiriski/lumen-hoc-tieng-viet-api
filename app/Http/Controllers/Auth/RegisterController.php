<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use JWTAuth;

class RegisterController extends Controller {
    
    /**
     * Handle the incoming request
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name'      => ['required', 'string', 'max:120'],
                'username'  => ['required', 'string', 'max:255', 'unique:users,username', 'regex:/^\S*$/u'],
                'email'     => ['required', 'email', 'unique:users'],
                'password'  => ['required', 'confirmed'],
            ]);
            
            if($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            
            $user = User::create([
                'name'      => $request->name,
                'username'  => $request->username,
                'email'     => $request->email,
                'password'  => app('hash')->make($request->password),
            ]);
            
            $token = JWTAuth::fromUser($user);
            return response()->json(
                compact('user', 'token'),
                JsonResponse::HTTP_CREATED
            );
        } catch (\Exception $exception) {
            return response()->json( [
                'message' => $exception->getMessage(),
            ], 409);
        }
    }
}