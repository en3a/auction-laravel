<?php

use App\Http\Controllers\ItemController;
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

Route::get('/', function ()
{
    return redirect()->route('dashboard');
});

Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');
    Route::get('/item/{item}', [ItemController::class, 'show'])->name('show');
});

require __DIR__.'/auth.php';

Auth::routes();
