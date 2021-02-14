<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller {

    /**
     * Handle the incoming request
     * 
     * use Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {

        $this->validate($request, [
            'username'  => ['string'],
            'email'     => ['string'],
            'password'  => ['required'],
        ]);

        $credentials = [];

        if($request->username !== null) {
            $credentials = $request->only(['username', 'password']);
        }

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'Invalid credentials!'
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }
        return $this->respondToken($token);
    }

    protected function respondToken($token) {
        return response()->json([
            'token'         => $token,
            'token_type'    => 'bearer',
            'expires_in'    => (int) Auth::factory()->getTTL()
        ], JsonResponse::HTTP_OK);
    }
}