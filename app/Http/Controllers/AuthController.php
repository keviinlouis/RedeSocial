<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\AuthCheckEmail;
use App\Rules\AuthCheckPassword;
use Auth;
use Illuminate\Validation\Rule;
use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    public function view(){
        return response()->json(Auth::user()->load(['posts', 'followers', 'following']));
    }

    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only(['email', 'password']);

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only(['email', 'password', 'name']);
            
        $this->validateRequest(
            $request->only(['email', 'password','password_confirmation', 'name']),
            $this->registerRules()
        );

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
        ]);

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($request->only(['email', 'password']))) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        $response = compact('token');
        $response["user"] = Auth::getUser();
        return response()->json();
    }

    public function destroy(Request $request){
        $this->validateRequest(
            $request->only(['email', 'password','password_confirmation', 'name']),
            $this->destroyRules()
        );

        try {
            Auth::user()->delete();

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
        return response()->json(["message" => "deleted"], 201);

    }

    public function loginRules(){
        return [
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function registerRules(){
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function destroyRules(){
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'exists:users,email',
                new AuthCheckEmail()
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ]
        ];
    }
}
