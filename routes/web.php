<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\Product_imageController::class, 'home'])->name('trangchu');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homeAdmin', [App\Http\Controllers\HomeController::class, 'home'])->name('homeAdmin')->middleware('checkAdmin');

Route::group(['middleware' => 'checkAdmin'], function () {
    //Category
    Route::get('/showCate', [App\Http\Controllers\CategoryController::class, 'index'])->name('showCate');
    Route::get('/addCate', [App\Http\Controllers\CategoryController::class, 'create'])->name('addCate');
    Route::post('/addCategory', [App\Http\Controllers\CategoryController::class, 'store'])->name('addCategory');
    Route::get('/editCate/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('editCate');
    Route::post('/updateCate/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('updateCate');
    Route::get('/destroyCate/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('destroyCate');
    Route::get('/activeCategory', [App\Http\Controllers\CategoryController::class, 'active'])->name('activeCategory');

    //product
    Route::get('/indexProduct', [App\Http\Controllers\ProductController::class, 'index'])->name('indexProduct');
    Route::get('/createProduct', [App\Http\Controllers\ProductController::class, 'create'])->name('createProduct');
    Route::post('/storeProduct', [App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct');
    Route::get('/editProducts/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProducts');
    Route::post('/updateProducts/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProducts');
    Route::get('/destroyProducts/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroyProducts');
    Route::get('/active', [App\Http\Controllers\ProductController::class, 'active'])->name('active');
    Route::get('/showbyBrand/{id}', [App\Http\Controllers\ProductController::class, 'showbyBrand'])->name('showbyBrand');
    Route::get('/showbyCate/{id}', [App\Http\Controllers\ProductController::class, 'showbyCate'])->name('showbyCate');

    //brands
    Route::get('/showBrand', [App\Http\Controllers\BrandController::class, 'index'])->name('showBrand');
    Route::get('/createBrand', [App\Http\Controllers\BrandController::class, 'create'])->name('createBrand');
    Route::post('/storeBrand', [App\Http\Controllers\BrandController::class, 'store'])->name('storeBrand');
    Route::get('/editBrand/{id}', [App\Http\Controllers\BrandController::class, 'edit'])->name('editBrand');
    Route::post('/updateBrand/{id}', [App\Http\Controllers\BrandController::class, 'update'])->name('updateBrand');
    Route::get('/destroyBrand/{id}', [App\Http\Controllers\BrandController::class, 'destroy'])->name('destroyBrand');
    Route::get('/activeBrand', [App\Http\Controllers\BrandController::class, 'active'])->name('activeBrand');

    //banners
    Route::get('/indexBanners', [App\Http\Controllers\BannerController::class, 'index'])->name('indexBanners');
    Route::get('/createBanners', [App\Http\Controllers\BannerController::class, 'create'])->name('createBanners');
    Route::post('/storeBanners', [App\Http\Controllers\BannerController::class, 'store'])->name('storeBanners');
    Route::get('/editBanners/{id}', [App\Http\Controllers\BannerController::class, 'edit'])->name('editBanners');
    Route::post('/updateBanners/{id}', [App\Http\Controllers\BannerController::class, 'update'])->name('updateBanners');
    Route::get('/destroyBanners/{id}', [App\Http\Controllers\BannerController::class, 'destroy'])->name('destroyBanners');
    Route::get('/activeBanner', [App\Http\Controllers\BannerController::class, 'active'])->name('activeBanner');

    //image
    Route::get('/showImage/{id}', [App\Http\Controllers\Product_imageController::class, 'show'])->name('showImage');
    Route::get('/createImage/{id}', [App\Http\Controllers\Product_imageController::class, 'create'])->name('createImage');
    Route::post('/storeImage', [App\Http\Controllers\Product_imageController::class, 'store'])->name('storeImage');
    Route::get('/destroyImage/{id}/{idp}', [App\Http\Controllers\Product_imageController::class, 'destroy'])->name('destroyImage');

    //order
    Route::get('/indexOrder', [App\Http\Controllers\OrderController::class, 'index'])->name('indexOrder');
    Route::get('/showbyId/{id}', [App\Http\Controllers\OrderController::class, 'showbyId'])->name('showbyId');
    Route::get('/updateOrder/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('updateOrder');
    Route::get('/exportOrder', [App\Http\Controllers\OrderController::class, 'export'])->name('exportOrder');

    //user
    Route::get('/indexUser', [App\Http\Controllers\UserController::class, 'index'])->name('indexUser');
    Route::get('/createUser', [App\Http\Controllers\UserController::class, 'create'])->name('createUser');
    Route::post('/storeUser', [App\Http\Controllers\UserController::class, 'store'])->name('storeUser');
    Route::get('/editUser/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editUser');
    Route::post('/updateUser/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('updateUser');
    Route::get('/destroyUser/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('destroyUser');
});

//product
Route::get('/showProduct/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('showProduct');
Route::get('/shop', [App\Http\Controllers\ProductController::class, 'shop'])->name('shop');
Route::get('/showbyTag/{tag}', [App\Http\Controllers\ProductController::class, 'showbyTag'])->name('showbyTag');
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');
Route::get('/searchName', [App\Http\Controllers\ProductController::class, 'searchName'])->name('searchName');
Route::get('/getSearchName', [App\Http\Controllers\ProductController::class, 'getSearchName'])->name('getSearchName');
Route::get('/showbyView/{status}', [App\Http\Controllers\ProductController::class, 'showbyView'])->name('showbyView');

Route::group(['middleware' => 'checkUser'], function () {
    //cart
    Route::post('/addCart', [App\Http\Controllers\CartController::class, 'save_cart'])->name('addCart');
    Route::get('/show_Cart', [App\Http\Controllers\CartController::class, 'show_cart'])->name('show_Cart');
    Route::get('/deleteCart/{rowId}', [App\Http\Controllers\CartController::class, 'delete_cart'])->name('deleteCart');
    Route::get('/show_Cart', [App\Http\Controllers\CartController::class, 'show_cart'])->name('show_Cart');
    // Route::get('/showAjaxCart', [App\Http\Controllers\CartController::class, 'show'])->name('showAjaxCart');
    Route::get('/quantityPlus', [App\Http\Controllers\CartController::class, 'quantityUpdate'])->name('quantityPlus');
    Route::get('/quantityMinus', [App\Http\Controllers\CartController::class, 'quantityMinus'])->name('quantityMinus');
    Route::post('/update_Cart', [App\Http\Controllers\CartController::class, 'update_quantity'])->name('update_Cart');
    Route::post('/storeCart', [App\Http\Controllers\CartController::class, 'store'])->name('storeCart');
    Route::get('/showCart/{id}', [App\Http\Controllers\CartController::class, 'show'])->name('showCart');
    Route::get('/cong/{id}', [App\Http\Controllers\CartController::class, 'cong'])->name('cong');
    Route::get('/tru/{id}', [App\Http\Controllers\CartController::class, 'tru'])->name('tru');
    Route::post('/updateCart/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('updateCart');
    Route::get('/destroyCart/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('destroyCart');

    //Order
    Route::get('/createOrder', [App\Http\Controllers\OrderController::class, 'create'])->name('createOrder');
    Route::post('/storeOrder', [App\Http\Controllers\OrderController::class, 'store'])->name('storeOrder');
    Route::post('/select-delivery', [App\Http\Controllers\OrderController::class, 'select_delivery'])->name('select-delivery');
    Route::get('/showOrder/{email}', [App\Http\Controllers\OrderController::class, 'show'])->name('showOrder');
    Route::get('/showItem/{id}', [App\Http\Controllers\OrderController::class, 'showItem'])->name('showItem');
    Route::get('/orderSuccess', [App\Http\Controllers\OrderController::class, 'orderSuccess'])->name('orderSuccess');
});


//Comment
Route::post('/storeComment', [App\Http\Controllers\CommentController::class, 'store'])->name('storeComment');
Route::post('/updateComment', [App\Http\Controllers\CommentController::class, 'update'])->name('updateComment');

//Report
Route::get('/indexReport', [App\Http\Controllers\ReportController::class, 'index'])->name('indexReport');
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// /Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('forget.password.get');

Route::post('/submitImport', [App\Http\Controllers\ImportController::class, 'import'])->name('submitImport');
Route::get('/importExportView', [App\Http\Controllers\ImportController::class, 'importExportView'])->name('importExportView');
Route::get('/submitExport', [App\Http\Controllers\ExportExcel::class, 'exportExcel'])->name('submitExport');