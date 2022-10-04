<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
//    $order = \App\Models\Order::query()->firstOrFail();
//    dd($order->user);
    $user = \App\Models\User::query()->firstOrFail();
    dd($user->orders);
});
