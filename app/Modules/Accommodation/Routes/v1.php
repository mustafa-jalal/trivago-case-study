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

    Route::middleware('auth:sanctum')->group(callback: function () {
        Route::resource('accommodations', AccommodationsController::class);
    });

    Route::get('users/{userId}/accommodations', [AccommodationsController::class, 'getUserAccommodations']);

    Route::post('accommodations/{accommodationId}/bookings', [BookingController::class, 'bookAccommodation']);
});


