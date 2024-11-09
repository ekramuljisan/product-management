<?php


use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class, 'ProductPage']);


Route::get('/product-list', [ProductController::class, 'ProductList']);
Route::post('/product-create', [ProductController::class, 'CreateProduct']);
Route::post('/product-delete', [ProductController::class, 'DeleteProduct']);
Route::post('/product-edit', [ProductController::class, 'EditProduct']);
Route::post('/by-product-id', [ProductController::class, 'ByProductID']);
