<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiUserLoginRequest;
use App\Http\Requests\ApiUserRegistrationRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiUserController extends Controller
{
    /**
     * User registration through API
     *
     * @param ApiUserRegistrationRequest $request
     * @return JsonResponse
     */

    public function register(ApiUserRegistrationRequest $request) {

        // Get validated data from the request
        $data = $request->validated();

        // Get address from the request
        $address = $data['address'];
        unset($data['address']);

        // Save address to the database
        $address = Address::create($address);

        // Add address_id to the user data
        $data['address_id'] = $address->id;

        // Hashing the password
        $data['password'] = Hash::make($data['password']);

        // Save the user data to the database
        User::create($data);

        // Return json response
        return response()->json(['status' => true])->setStatusCode(201);
    }

    /**
     * User authorization through API
     *
     * @param ApiUserLoginRequest $request
     * @return JsonResponse
     */
    public function login(ApiUserLoginRequest $request) {

        // Get validated data from the request
        $data = $request->validated();

        // Get the user from the database by his login
        $user = User::query()->where('login', $data['login'])->first();

        // If login exists in the database and password is correct save user api_token and return user_id
        if ($user && Hash::check($data['password'], $user->password)) {
            $user->api_token = Str::random(60);
            $user->save();

            return response()
                ->json([
                    'status' => true,
                    'user_id' => $user
                ])
                ->setStatusCode(200, 'Authorized');
        } else {
            return response()
                ->json([
                    'status' => false,
                ])
                ->setStatusCode(401, 'Unauthorized');
        }
    }
}
