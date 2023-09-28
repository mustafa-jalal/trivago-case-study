<?php


use App\Modules\Accommodation\Controllers\AccommodationsController;
use App\Modules\Accommodation\Controllers\BookingController;
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

Route::prefix('v1')->group(callback: function ()
{

    Route::prefix('accommodations')->group(function ()
    {
        Route::middleware('auth:sanctum')->group(callback: function () {
            Route::post('/', [AccommodationsController::class, 'store']);
            Route::put('/{id}', [AccommodationsController::class, 'update']);
            Route::delete('/{id}', [AccommodationsController::class, 'destroy']);
        });

        Route::get('/', [AccommodationsController::class, 'index']);
        Route::get('/{id}', [AccommodationsController::class, 'show']);
        Route::post('/{accommodationId}/bookings', [BookingController::class, 'bookAccommodation']);
    });

    Route::get('users/{userId}/accommodations', [AccommodationsController::class, 'getUserAccommodations']);
});


