<?php

use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\ClientContactController;
use App\Http\Controllers\Api\V1\WebsiteController;
use App\Http\Controllers\Api\V1\HostingDetailController;
use App\Http\Controllers\Api\V1\SerivceLevelController;
use App\Http\Controllers\Api\V1\TechnologyController;
use App\Http\Controllers\Api\V1\UserController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('clients', ClientController::class);
    Route::resource('clientContacts', ClientContactController::class);
    Route::resource('websites', WebsiteController::class);
    Route::resource('hostingDetails', HostingDetailController::class);
    Route::resource('serviceLevels', SerivceLevelController::class);
    Route::resource('technologies', TechnologyController::class);
});
