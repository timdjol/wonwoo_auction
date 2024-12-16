<?php

use App\Http\Controllers\AuctionController;
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
    Route::middleware('auth', 'auth.session')->group(function()
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
                Route::get('/sendemail',
                    [App\Http\Controllers\Admin\OrderController::class, 'sendEmail'])->name('sendemail');
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
                Route::resource("payments", "App\Http\Controllers\Admin\PaymentController");
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
    Route::get('/search', [MainController::class, 'search'])->name('search');

    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contactspage', [PageController::class, 'contacts'])->name('contactspage');
    Route::get('/policy', [PageController::class, 'policy'])->name('policy');
    Route::get('/oferta', [PageController::class, 'oferta'])->name('oferta');
    Route::get('/dogovor', [PageController::class, 'dogovor'])->name('dogovor');
    Route::get('/stock', [PageController::class, 'stock'])->name('stock');
    Route::post('/api/fetch-states', [PageController::class, 'fetchState']);
    Route::get('/contactpage', [PageController::class, 'contactpage'])->name('contactpage');
    Route::post('/contact-form',  [PageController::class, 'contactform'])->name('contactform');

    Route::get('/auctions/index/{id}', [AuctionController::class, 'index'])->name('auctions.index');
    Route::get('/bid/{id}', [AuctionController::class, 'bid'])->name('auctions.bid');
    Route::post('/auctions', [AuctionController::class, 'store'])->name('auctions.store');
    Route::post('/orderform', [AuctionController::class, 'orderFormBuy'])->name('orderform');
    Route::get('/deposit', [AuctionController::class, 'deposit'])->name('deposit');
    Route::get('/paybox', [AuctionController::class, 'paybox'])->name('paybox');
    Route::get('/sales', [AuctionController::class, 'sales'])->name('sales');
    Route::get('/listings', [AuctionController::class, 'listings'])->name('listings');
    Route::get('/sales?tab=tab-{page}', [AuctionController::class, 'sale'])->name('sale');
    Route::get('/end', [AuctionController::class, 'end'])->name('end');
    Route::get('/pause', [AuctionController::class, 'pause'])->name('pause');
    Route::get('/pause2', [AuctionController::class, 'pause2'])->name('pause2');
    Route::get('/pause3', [AuctionController::class, 'pause3'])->name('pause3');
    Route::get('/pause4', [AuctionController::class, 'pause4'])->name('pause4');
    Route::get('/pause5', [AuctionController::class, 'pause5'])->name('pause5');
    Route::get('/pause6', [AuctionController::class, 'pause6'])->name('pause6');
    //Route::get('/sale_frame', [AuctionController::class, 'sale_frame'])->name('sale_frame');
    //Route::get('/socket', 'App\Http\Controllers\PusherController@index')->name('socket');
    //Route::post('/broadcast', 'App\Http\Controllers\PusherController@broadcast')->name('broadcast');
    //Route::post('/receive', 'App\Http\Controllers\PusherController@receive')->name('receive');
    //Route::get('/send', 'App\Http\Controllers\AuctionController@sendMessage')->name('sendMessage');
    Route::get('/send', 'App\Http\Controllers\AuctionController@sendMessage')->name('sendMessage');


    Route::get('/failure', [PageController::class, 'failure_page'])->name('failure_page');
    Route::get('/check', [PageController::class, 'check_page'])->name('check_page');
    Route::get('/state', [PageController::class, 'state_page'])->name('state_page');
    Route::get('/success', [PageController::class, 'success_page'])->name('success_page');

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

