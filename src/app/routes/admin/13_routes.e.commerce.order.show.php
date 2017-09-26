<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function () {
    Route::get('e-commerce/orders/{_id}', [
            'as'         => 'admin.routes.e.commerce.orders.{_id}.index',
            'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_list'],
            'uses'       => 'ecommerce\\orders\\HCECOrderShowController@index']
    );
});