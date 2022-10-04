<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiDeliveryCostRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class ApiDeliveryController extends Controller
{
    public function calculateDeliveryCost(ApiDeliveryCostRequest $request) {
        $data = $request->validated();
        $this->addAddress($data);

        if (in_array($data['district'], ['Moskovskiy', 'Frunzenskiy', 'Oktiabrskiy'])) {
            return response()->json([
                'status' => true,
                'delivery_cost' => '$3'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'delivery_cost' => '$5'
            ]);
        }
    }

    public function addAddress($data) {
        $user = User::query()->find($data['user_id']);
        $address = Address::query()->find($user->address->id);
        if (isset($address)) {
            $address->update($data);
        } else {
            $address->create($data);
        }
    }
}
