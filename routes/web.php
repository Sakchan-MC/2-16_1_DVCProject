<?php

use App\Http\Livewire\Admin\Categories;
use App\Http\Livewire\Admin\Products;
use App\Http\Livewire\Product;
use App\Http\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Welcome::class)->name("home");
Route::get('/product', Product::class)->name("product");

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->name("admin.")
    ->prefix("admin")
    ->group(function () {
//        Route::get('/', function () {
//            return view('dashboard');
//        })->name('index');
        Route::get("/", Products::class)->name("product");
        Route::get("categories", Categories::class)->name("category");

    });

