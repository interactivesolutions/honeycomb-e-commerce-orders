<?php

Route::group(['prefix' => '{lang}', 'namespace' => 'frontend'], function () {
    Route::get('invoice/{orderId}', ['as' => 'en.order.invoice', 'uses' => 'HCECOrdersController@invoice']);
    Route::get('saskaita/{orderId}', ['as' => 'lt.order.invoice', 'uses' => 'HCECOrdersController@invoice']);
});