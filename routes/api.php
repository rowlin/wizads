
<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TreeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::post('login', LoginController::class)->name('auth.login');
Route::post('register', RegisterController::class)->name('auth.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    })->name('auth.user');

    Route::post('logout', function (Request $request) {
        return $request->user()->tokens()->delete();
    })->name('auth.logout');

    Route::group(['prefix' => 'tree'], function () {
        Route::get('/', [TreeController::class , 'index'])->name('tree.index');
        Route::get('/{id}', [TreeController::class, 'getById'])->name('tree.tree');
        Route::post('/create', [TreeController::class , 'create'])->name('tree.create');
        Route::delete('/{id}', [TreeController::class, 'delete' ])->name('tree.delete');
        Route::patch('/{id}', [TreeController::class, 'update'])->name('tree.update');


    });

});
