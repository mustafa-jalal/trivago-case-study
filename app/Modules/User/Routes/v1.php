<?php


use App\Modules\User\Controllers\Auth\AuthController;
use Illuminate\Routing\Router;
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

Route::prefix('v1')->group(callback: function (Router $router) {
    $router->prefix('/auth')->group(function () {
        // TODO; ->name() not used for all routes
        Route::post('/register', [AuthController::class, 'register'])->name('user.register');
        Route::post('/login', [AuthController::class, 'login'])->name('user.login');
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/logout', [AuthController::class, 'logout']);
        });
    });
});
