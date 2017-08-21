<?php

Route::group(['middleware' => 'web'], function () {
    Route::post('api/cart', [
        'as'   => 'api.cart.item.add',
        'uses' => 'frontend\\HCECCartsController@add',
    ]);

    Route::put('api/cart/item/{cartItemId}', [
        'as'   => 'api.cart.item.update',
        'uses' => 'frontend\\HCECCartsController@update',
    ]);

    Route::delete('api/cart/item/{cartItemId}', [
        'as'   => 'api.cart.item.delete',
        'uses' => 'frontend\\HCECCartsController@delete',
    ]);

});