<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
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

Route::get('/logout', 'App\Http\Controllers\ProfileController@logout')->name('get-logout');


Route::middleware('set_locale')->group(function(){
    Route::middleware('auth')->group(function()
    {
        Route::group([
            "prefix" => "person",
            "as" => "person.",
        ], function ()
        {
            Route::get('/auctions', [\App\Http\Controllers\Person\AuctionController::class, 'index'])->name('auctions.index');
            //Route::get('/orders/{order}',[\App\Http\Controllers\Person\AuctionController::class, 'show'])->name('orders.show');
        });

        Route::group([
            "prefix" => "admin"
        ], function ()
        {
            Route::group(["middleware" => "is_admin"], function ()
            {
                Route::get('/dashboard',
                    [App\Http\Controllers\Admin\OrderController::class, 'dashboard'])->name('dashboard');
                Route::resource("orders", "App\Http\Controllers\Admin\OrderController");
                Route::resource("forms", "App\Http\Controllers\Admin\FormController");
                Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');
                Route::resource('brands', 'App\Http\Controllers\Admin\BrandController');
                Route::resource('models', 'App\Http\Controllers\Admin\ModelController');
                Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
                Route::resource("contacts", "App\Http\Controllers\Admin\ContactController");
                Route::resource("pages", "App\Http\Controllers\Admin\PageController");
                Route::resource("sliders", "App\Http\Controllers\Admin\SliderController");
                Route::resource("users", "App\Http\Controllers\Admin\UserController");
                Route::resource("countries", "App\Http\Controllers\Admin\CountryController");
                Route::resource("regions", "App\Http\Controllers\Admin\RegionController");
            });
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';


    Route::get('/', [MainController::class, 'index'])->name('index');
    Route::get('/catalog', [MainController::class, 'catalog'])->name('catalog');
    Route::get('/categories', [MainController::class, 'categories'])->name('categories');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contactspage', [PageController::class, 'contacts'])->name('contactspage');
    Route::get('/policy', [PageController::class, 'policy'])->name('policy');
    Route::get('/oferta', [PageController::class, 'oferta'])->name('oferta');
    Route::get('/search', [MainController::class, 'search'])->name('search');
    Route::get('/stock', [PageController::class, 'stock'])->name('stock');



    Route::post('/api/fetch-states', [PageController::class, 'fetchState']);

    Route::get('/contactpage', [MainController::class, 'contactpage'])->name('contactpage');
    Route::get('contact-form', 'MainController@createform');
    Route::post('/contact-form/{product}', 'MainController@storeform');

    Route::get('/auctions/index/{id}', [AuctionController::class, 'index'])->name('auctions.index');
    Route::post('/auctions', [AuctionController::class, 'store'])->name('auctions.store');
    Route::post('/orderform', [AuctionController::class, 'orderFormBuy'])->name('orderform');
    Route::get('/deposit', [AuctionController::class, 'deposit'])->name('deposit');
    //Route::get('/deposit-success', [AuctionController::class, 'deposit_success'])->name('deposit-success');
    Route::get('/paybox', [AuctionController::class, 'paybox'])->name('paybox');
    Route::get('/failure', [PageController::class, 'failure_page'])->name('failure_page');
    Route::get('/check', [PageController::class, 'check_page'])->name('check_page');
    Route::get('/state', [PageController::class, 'state_page'])->name('state_page');


    Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/add/{product?}', 'App\Http\Controllers\WishlistController@wishlistAdd')->name('wishlist-add');
    Route::post('/wishlist/remove/{product}', 'App\Http\Controllers\WishlistController@wishlistRemove')->name('wishlist-remove');

    Route::get('/brand/{brand}', [MainController::class, 'brand'])->name('brand');
    Route::get('/brand/{brand}/{product}', [MainController::class, 'product'])->name('product');
    Route::get('/model/{model}', [MainController::class, 'model'])->name('model');
    Route::get('/model/{model}/{product}', [MainController::class, 'product'])->name('product');
    Route::get('/category/{category}', [MainController::class, 'category'])->name('category');
    Route::get('/category/{category}/{product}', [MainController::class, 'product'])->name('product');
});

