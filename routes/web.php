<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Models\Book;
use App\Models\Category;
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

Route::get('/', function () {
    return view('layout.pages.homepage')
        ->with("categories", Category::all())
        ->with("new_books", Book::all()->sortBy("created_at")->take(4));
});

Route::get('shopping-cart', function () {
    return view('layout.pages.shopping-cart')->with("categories", Category::all());
});

Route::resource('book', BookController::class);

Route::resource('category', CategoryController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

//Route::post('/category', 'CategoryController@showWithSearch');

Route::get('/add-to-cart/{id}', [
    'uses' => 'BookController@getAddToCart',
    'as' => 'book.addToCart'
]);
