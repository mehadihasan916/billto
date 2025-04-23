<?php

use App\Http\Controllers\frontend\DashboardController;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\PaymentGetway;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPackage;
use App\Models\ComplateInvoiceCount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\SubscriptionPackContoller;
use App\Models\SendMail_info;

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
// only multi-language
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

// Web site Normal pages
Route::get('/', [PagesController::class, 'index'])->name('home');
Route::post('/load-data', [PagesController::class, 'loadData'])->name('load-more-data');
Route::get('/privacy-policy', [PagesController::class, 'privacyPolicy'])->name('privacy.policy');
Route::post('/create/bill', [PagesController::class, 'createbill'])->name('create.boll');


//payment payment gateway
Route::get('/payment-gateway/{package_id}', [SubscriptionPackContoller::class, 'payment_gateway']);


require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
require __DIR__ . '/socialite.php';

// product add route With Ajax


// Invoice Route
Route::post('/products/create', [ProductController::class, 'index']);
Route::post('/product/store', [ProductController::class, 'store'])->name('store.product');
Route::delete('/products/delete/{id}', [ProductController::class, 'destroy']);
Route::PUT('/products/update', [ProductController::class, 'update']);
Route::get('/create/invoice', [InvoiceController::class, 'index'])->name('create');
// Route::post('/loadmore',[InvoiceController::class, 'loadmore']);

Route::group(['middleware' => ['auth', 'verified']], function () {

    // Route::post('/products/create', [ProductController::class, 'index']);
    // Route::post('/product/store', [ProductController::class, 'store'])->name('store.product');
    // Route::delete('/products/delete/{id}', [ProductController::class, 'destroy']);
    // Route::PUT('/products/update', [ProductController::class, 'update']);
    // Route::get('/create/invoice', [InvoiceController::class, 'index'])->name('create');
    Route::post('/invoices/store', [InvoiceController::class, 'store'])->name('store.');

    Route::get('/invoice/complate/page/{id}', [InvoiceController::class, 'complate_invoice']);
    Route::get('home/invoice/page/{id}', [InvoiceController::class, 'index_home']);

    Route::post('/invoices/complete/{id}', [InvoiceController::class, 'complete'])->name('complete.');
    // Route::get('/invoice/download/{id}', [InvoiceController::class, 'download'])->name('invoice.download');
    Route::get('/invoice/download/{id}', [InvoiceController::class, 'invoice_download'])->name('invoice.download');

    // send invoice mail with PDF
    Route::post('/create/invoice/send', [InvoiceController::class, 'send_invoice']);


    //payment payment gateway
    Route::post('/payment/store', [SubscriptionPackContoller::class, 'payment_gateway_store'])->name('payment.store');


    // just chek route
    Route::get('/preview/image/{id}', [InvoiceController::class, 'previewImage']);
});
Route::get('/test/bill', [DashboardController::class, 'test_bill']);


// Clear all cache with a single function
Route::get('/optimize-clear', function () {
    $exitCode = Artisan::call('optimize:clear');
    return 'Application cache cleared successfully';
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize');
    return redirect()->back();
});
Route::get('/notice/div/hidden', function () {
    Session::put('hidden_session', 'd-none');
    return redirect()->back();
});
