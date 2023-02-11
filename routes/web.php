<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\API\GoogleController;

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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'Admin']], function(){

    Route::get('admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('admin/dashboard/trash', [App\Http\Controllers\Admin\DashboardController::class, 'trash'])->name('trash');
    Route::get('admin/dashboard/restore/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'restore'])->name('trash-restore');
    Route::get('admin/dashboard/force/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'force'])->name('trash-force');
    Route::get('admin/dashboard/create', [App\Http\Controllers\Admin\DashboardController::class, 'create'])->name('add');
    Route::post('admin/dashboard/create/success', [App\Http\Controllers\Admin\DashboardController::class, 'store'])->name('store');
    Route::get('admin/dashboard/edit/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'edit'])->name('edit');
    Route::resource('/dashboard-update', \App\Http\Controllers\Admin\DashboardController::class);
    Route::delete('admin/dashboard/deleted{id}', [App\Http\Controllers\Admin\DashboardController::class, 'destroy'])->name('destroy');
    Route::get('admin/dashboard/show{id}', [App\Http\Controllers\Admin\DashboardController::class, 'show'])->name('show');
    Route::post('upload', [App\Http\Controllers\Admin\DashboardController::class, 'storeImage'])->name('storeImages');

    Route::get('admin/shop', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('shop');
    Route::get('admin/shop/trash', [App\Http\Controllers\Admin\ProductController::class, 'trash'])->name('trash-shop');
    Route::get('admin/shop/restore/{id}', [App\Http\Controllers\Admin\ProductController::class, 'restore'])->name('trash-restore-shop');
    Route::get('admin/shop/force/{id}', [App\Http\Controllers\Admin\ProductController::class, 'force'])->name('trash-force-shop');
    Route::get('admin/shop/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('add-shop');
    Route::post('admin/shop/create/success', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('store-shop');
    Route::get('admin/shop/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('edit-shop');
    Route::resource('/shop-update', \App\Http\Controllers\Admin\ProductController::class);
    Route::delete('admin/shop/deleted{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('destroy-shop');
    Route::get('admin/shop/show{id}', [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('show-shop');
    Route::post('admin/shop/image', [App\Http\Controllers\Admin\ProductController::class, 'storeImage'])->name('storeImages-shop');

    Route::get('admin/news', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('news');
    Route::get('admin/news/trash', [App\Http\Controllers\Admin\NewsController::class, 'trash'])->name('trash-news');
    Route::get('admin/news/restore/{id}', [App\Http\Controllers\Admin\NewsController::class, 'restore'])->name('trash-restore-news');
    Route::get('admin/news/force/{id}', [App\Http\Controllers\Admin\NewsController::class, 'force'])->name('trash-force-news');
    Route::get('admin/news/create', [App\Http\Controllers\Admin\NewsController::class, 'create'])->name('add-news');
    Route::post('admin/news/create/success', [App\Http\Controllers\Admin\NewsController::class, 'store'])->name('store-news');
    Route::get('admin/news/edit/{id}', [App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('edit-news');
    Route::resource('/news-update', \App\Http\Controllers\Admin\NewsController::class);
    Route::delete('admin/news/deleted{id}', [App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('destroy-news');
    Route::get('admin/news/show{id}', [App\Http\Controllers\Admin\NewsController::class, 'show'])->name('show-news');
    Route::post('admin/news/image', [App\Http\Controllers\Admin\NewsController::class, 'storeImage'])->name('storeImages-news');

    Route::get('admin/main', [App\Http\Controllers\Admin\mainController::class, 'index'])->name('main');
    Route::get('admin/main/trash', [App\Http\Controllers\Admin\mainController::class, 'trash'])->name('trash-main');
    Route::get('admin/main/restore/{id}', [App\Http\Controllers\Admin\mainController::class, 'restore'])->name('trash-restore-main');
    Route::get('admin/main/force/{id}', [App\Http\Controllers\Admin\mainController::class, 'force'])->name('trash-force-main');
    Route::get('admin/main/create', [App\Http\Controllers\Admin\mainController::class, 'create'])->name('add-main');
    Route::post('admin/main/create/success', [App\Http\Controllers\Admin\mainController::class, 'store'])->name('store-main');
    Route::get('admin/main/edit/{id}', [App\Http\Controllers\Admin\mainController::class, 'edit'])->name('edit-main');
    Route::resource('/main-update', \App\Http\Controllers\Admin\mainController::class);
    Route::delete('admin/main/deleted{id}', [App\Http\Controllers\Admin\mainController::class, 'destroy'])->name('destroy-main');
    Route::get('admin/main/show{id}', [App\Http\Controllers\Admin\mainController::class, 'show'])->name('show-main');
    Route::post('admin/main/image', [App\Http\Controllers\Admin\mainController::class, 'storeImage'])->name('storeImages-main');




});

Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('landing-page');
Route::get('/homes/shop', [App\Http\Controllers\LandingPageController::class, 'shop'])->name('landing-page-2');
Route::get('/homes/news', [App\Http\Controllers\LandingPageController::class, 'news'])->name('landing-page-3');
Route::get('/shop/detail/{id}', [App\Http\Controllers\LandingPageController::class, 'detail'])->name('detail-shop');

Route::controller(GoogleController::class)->group(function(){
    Route::get('/auth/{provider}', [GoogleController::class, 'redirectToProvider']);
    Route::get('/auth/{provider}/callback', [GoogleController::class, 'handleProvideCallback']);
});

// excel
Route::get('/download', [App\Http\Controllers\DownloadController::class, 'download'])->name('download');
// Route::get('/data/all', [App\Http\Controllers\Admin\MainController::class, 'getAllData']);

// API Payment
Route::get('/item/{id}/checkout', [App\Http\Controllers\Admin\ProductController::class, 'checkout'])->name('checkout');
Route::get('/transaction/{reference}', [App\Http\Controllers\TransactionController::class, 'show'])->name('transaction.show');
Route::post('/transaction', [App\Http\Controllers\TransactionController::class, 'store'])->name('transaction.store');
Route::post('/callback', [App\Http\Controllers\TripayCallbackController::class, 'handle'])->name('callback');
Route::get('/admin/dashboard/transaction', [App\Http\Controllers\TransactionController::class, 'history'])->name('transaction.his');
Route::get('/mail', [App\Http\Controllers\TransactionController::class, 'mail'])->name('testMail');

