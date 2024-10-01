<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\EmailController;
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

Route::get('/', [HomeController::class, 'home'])->name('welcome')->middleware('setLocale');
Route::get('/dil-degistir', [HomeController::class, 'changelocale'])->name('changelocale');

Route::get('/kitaplar/disa-aktar', [ BookController::class ,'export'])->name('users.books.export');

Route::get('/kitaplar/{id}', [HomeController::class, 'show'])->name('users.books.show');


Route::get('/sepet', [ShoppingController::class, 'index'])->name('shopping.index');
Route::get('/sepete-ekle/{id}', [ShoppingController::class, 'addtocart'])->name('shopping.addtocart');
Route::get('/sepetten-cikar/{raw_id}', [ShoppingController::class, 'removefromcart'])->name('shopping.removefromcart');
Route::get('/sepeti-guncelle/{raw_id}/{type}', [ShoppingController::class, 'updatecart'])->name('shopping.updatecart');
Route::post('/siparisi-olustur', [OrderController::class, 'store'])->name('orders.store');

Route::get('/siparis-basarili', [OrderController::class, 'success'])->name('orders.success');
Route::get('/siparis-basarisiz', [OrderController::class, 'fail'])->name('orders.fail');

Route::get('/mail-gonder/{product_id}', [EmailController::class, 'products'])->name('emails.product');


Route::resource('/firebase', FirebaseController::class);


/* Route::controller(TestController::class)->group(function(){
    Route::get('admin/deneme', 'test')->name('test');
    Route::get('admin/detail', 'detail')->name('detail');
}); */

Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('/deneme',  [ TestController::class ,'test'])->name('test');
    Route::get('/detail', [ TestController::class ,'detail'])->name('detail');
    
    Route::get('/kitaplar', [ BookController::class ,'index'])->name('books.index')->middleware('setLocale');
    Route::get('/kitaplar/ekle', [ BookController::class ,'create'])->name('books.create');
    Route::post('/kitaplar/ekle', [ BookController::class ,'store'])->name('books.store');
    Route::post('/kitaplar/disa-aktar', [ BookController::class ,'import'])->name('books.import');
    Route::get('/kitaplar/{book}', [ BookController::class ,'edit'])->name('books.edit');
    Route::post('/kitaplar/{book}', [ BookController::class ,'update'])->name('books.update');
    Route::get('/kitaplar/sil/{book}', [ BookController::class ,'delete'])->name('books.delete');
    Route::get('/kitaplar/geri-getir/{book}', [ BookController::class ,'restore'])->name('books.restore')->withTrashed();
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

