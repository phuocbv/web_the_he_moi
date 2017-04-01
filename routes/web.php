<?php

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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

// Route::get('/categories/{id}/products', ['as' => 'category.show',
//     'uses' => 'CategoriesControllers@showProductInCategory']);
Route::get('/categories/{id}/products', ['as' => 'category.show',
    'uses' => 'CategoriesControllers@searchProductInCategory']);

Route::get('/searchProduct', ['as' => 'searchProduct',
    'uses' => 'HomeController@searchProduct']);

Route::resource('/product', 'ProductController');

Route::resource('shop', 'ShopController');

Route::post('products/{id}/rate', ['as' => 'rate.create',
    'uses' => 'ProductController@addRate']);

Route::post('shops/{id}/follow', ['as' => 'shop.follow',
    'uses' => 'ShopController@follow']);

Route::post('shops/{id}/like', ['as' => 'shop.like',
    'uses' => 'ShopController@like']);

Route::post('category/{id}/searchProduct', ['as' => 'category.searchProduct',
    'uses' => 'CategoriesControllers@searchProduct']);

Route::get('shopCollection/{id}', [ 'as' => 'shopCollection.show',
    'uses' => 'ShopController@shopCollection']);

Route::post('collection/{id}/searchProduct', [ 'as' => 'shopCollection.searchProduct',
    'uses' => 'ShopController@searchProduct']);

Auth::routes();

Route::get('auth/{provider}', [
    'as' => 'provider.redirect',
    'uses' => 'Auth\LoginController@redirectToProvider'
]);

Route::get('auth/{provider}/callback', [
    'as' => 'provider.handle',
    'uses' => 'Auth\LoginController@handleProviderCallback'
]);

Route::get('users/activation/{id}/{token}', [
    'as' => 'users.activation',
    'uses' => 'Auth\RegisterController@userActivation'
]);


Route::group(['middleware' => 'auth'], function() {
    Route::resource('users', 'UserController', ['only' => [
        'edit', 'update'
    ]]);
});

Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => 'auth', 'as' => 'user.'], function() {
    Route::resource('shop', 'ShopController');

    Route::get('/myShop', ['as' => 'user.myShop', 
        'uses' => 'ShopController@myShop']);

    Route::get('/myProducts', ['as' => 'user.myProducts', 
        'uses' => 'ShopController@showShopOfUser']);

    Route::get('/myCollection', ['as' => 'user.myCollection',
        'uses' => 'CollectionController@myCollection']);

    Route::resource('cart', 'CartController', [ 'only' => [
        'index', 'store'
    ]]);

    Route::get('orderedProduct', [
        'as' => 'user.orderedProduct',
        'uses' => 'OrderController@listOrderedProduct'
    ]);

    Route::post('searchOrder', [
        'as' => 'user.searchOrder',
        'uses' => 'OrderController@listOrderedProduct'
    ]);

    Route::get('cart/clear-cart', [
        'as' => 'cart.clear',
        'uses' => 'CartController@clearCart'
    ]);

    Route::post('cart/remove', [
        'as' => 'cart.remove',
        'uses' => 'CartController@destroy'
    ]);

    Route::get('cart/up', [
        'as' => 'cart.up',
        'uses' => 'CartController@upQuantity'
    ]);

    Route::get('cart/down', [
        'as' => 'cart.down',
        'uses' => 'CartController@downQuantity'
    ]);

    Route::resource('collection', 'CollectionController');

    Route::post('/collection/updateAjax', [
        'as' => 'collection.postUpdateAjax', 
        'uses' => 'CollectionController@postUpdateAjax'
    ]);

    Route::post('/collection/deleteAjax', [
        'as' => 'collection.postDeleteAjax', 
        'uses' => 'CollectionController@postDeleteAjax'
    ]);

    Route::post('/collection/add-product', [
        'as' => 'collection.add-product', 
        'uses' => 'CollectionController@addProduct'
    ]);

    Route::post('/collection/remove-product', [
        'as' => 'collection.remove-product', 
        'uses' => 'CollectionController@removeProduct'
    ]);

    Route::resource('order', 'OrderController', [ 'only' => [
        'index', 'store'
    ]]);

    Route::resource('bill', 'BillController', [ 'only' => [
        'index', 'show'
    ]]); 
});

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function() {
    Route::resource('category', 'CategoryController');

    Route::resource('users', 'UserController');
});
