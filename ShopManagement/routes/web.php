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

//Home 
Route::get('/home',[AuthController::class,'authFn'])->middleware('auth','verified')->name('home');
/*****/

// ShopOwner Middleware--
Route::get('/register_shop',[CrudController::class,'registerShopPage'])->middleware(['shopowner'])->name('registerShopPage');
Route::get('/add_product',[CrudController::class,'addProductPage'])->middleware(['shopowner'])->name('addProductPage');
Route::get('/edit_product/{id}',[CrudController::class,'editProductPage'])->middleware(['shopowner'])->name('editProductPage');
Route::get('/edit_shop',[CrudController::class,'editShopPage'])->middleware(['shopowner'])->name('editShopPage');

//Shop 
Route::post('/create_shop',[CrudController::class,'createShop'])->name('createShop');
Route::post('/editing_shop',[CrudController::class,'editShop'])->name('editShop');
Route::post('/adding_product',[CrudController::class,'addProduct'])->name('addProduct');
Route::post('/editing_product/{id}',[CrudController::class,'editProduct'])->name('editProduct');
Route::get('/delete_product/{id}',[CrudController::class,'deleteProduct'])->name('deleteProduct');
/*****/

//Approval 
Route::get('/sent_approval',[CrudController::class,'sentApproval'])->name('sentApproval');
Route::get('/approved/{id}',[CrudController::class,'approved'])->name('approved');
Route::get('/rejected/{id}',[CrudController::class,'rejectedApproval'])->name('rejectedApproval');
/*****/

//Customer 
Route::post('/filter',[CrudController::class,'filtering']);
Route::post('/filter_category',[CrudController::class,'filterCategory']);
Route::post('/sort_by_higher',[CrudController::class,'sortByHigher']);
Route::post('/sort_by_lower',[CrudController::class,'sortByLower']);
/*****/

//Admin Middleware --
Route::get('/approvals',[CrudController::class,'approvalPage'])->middleware(['admin'])->name('approvalPage');
Route::get('/products_page',[CrudController::class,'productsPage'])->middleware(['admin'])->name('productsPage');
Route::get('/users_page',[CrudController::class,'usersPage'])->middleware(['admin'])->name('usersPage');
Route::get('/blocked_user',[CrudController::class,'blockedPage'])->middleware(['admin'])->name('blockedPage');
/*****/

//Admin --
Route::get('/delete_user/{id}',[CrudController::class,'deleteUser'])->name('deleteUser');
Route::get('/block_user/{id}',[CrudController::class,'blockUser'])->name('blockUser');
Route::get('/remove_block/{id}',[CrudController::class,'removeBlock'])->name('removeBlock');
Route::get('/delete_shop/{id}',[CrudController::class,'deleteShop'])->name('deleteShop');
/*****/





