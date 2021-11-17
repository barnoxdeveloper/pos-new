<?php

use App\Http\Controllers\Admin\{HomeController, UserController, ProductsController};
use Illuminate\Support\Facades\{Route, Auth, Artisan};

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
})->name('/');

Route::get('login', function () {
	return view('auth.login');
})->name('login');

Route::middleware(['auth', 'verified', 'active' ,'admin', 'revalidate'])
        ->group(function()
{
    // route for admin dashboard
	Route::get('/home', [HomeController::class, 'index'])->name('admin-dashboard');
	Route::resource('admin-user', UserController::class)->except(['show']);
	Route::resource('admin-products', ProductsController::class)->except(['show']);
});

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/clear', function() {
	Artisan::call('config:clear');
	Artisan::call('config:cache');
	Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
	return "All cache is cleared";
});
