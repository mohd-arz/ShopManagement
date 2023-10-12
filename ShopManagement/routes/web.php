<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/**************************************/

Route::get('/home',[AuthController::class,'authFn'])->middleware('auth','verified')->name('home');

// Shop
Route::get('/register_shop',[CrudController::class,'registerShopPage'])->name('registerShopPage');
Route::get('/sent_approval',[CrudController::class,'sentApproval'])->name('sentApproval');

Route::get('/approvals',[CrudController::class,'approvalPage'])->name('approvalPage');
Route::get('/approved/{id}',[CrudController::class,'approved'])->name('approved');

Route::get('/add_product',[CrudController::class,'addProductPage'])->name('addProductPage');
Route::post('/adding_product',[CrudController::class,'addProduct'])->name('addProduct');

Route::get('/edit_product/{id}',[CrudController::class,'editProductPage'])->name('editProductPage');
Route::post('/editing_product/{id}',[CrudController::class,'editProduct'])->name('editProduct');
Route::get('/delete_product/{id}',[CrudController::class,'deleteProduct'])->name('deleteProduct');

Route::get('/products_page',[CrudController::class,'productsPage'])->name('productsPage');

Route::get('/delete_shop/{id}',[CrudController::class,'deleteShop'])->name('deleteShop');

Route::post('/filter',[CrudController::class,'filtering']);

Route::post('/create_shop',[CrudController::class,'createShop'])->name('createShop');



