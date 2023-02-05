<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Members\FamilyHousesController;
use App\Http\Controllers\Members\FamilyMembersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('authentication')->group(function () {

    Route::post('login', [AuthenticationController::class, 'login']);

    Route::get('forgot-password', [AuthenticationController::class, 'forgotPassword']);

    Route::put('reset-password', [AuthenticationController::class, 'resetPassword']);

    Route::get('logout', [AuthenticationController::class, 'logout']);
});

Route::prefix('family')->group(function () {

    Route::prefix('members')->group(function () {

        Route::post('create', [FamilyMembersController::class, 'create']);

        Route::get('list', [FamilyMembersController::class, 'listMembers']);

        Route::put('update/{id}', [FamilyMembersController::class, 'updateMembers']);
    });

    Route::prefix("houses")->group(function () {

        Route::post("create", [FamilyHousesController::class, 'createFamilyHouse']);

        Route::get("list", [FamilyHousesController::class, 'listFamilyHouses']);

        Route::put("update/{id}", [FamilyHousesController::class, "updateFamilyHouses"]);
    });
});
