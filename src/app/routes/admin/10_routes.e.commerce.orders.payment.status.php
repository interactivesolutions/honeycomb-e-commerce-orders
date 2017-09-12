<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/orders/payment/status', ['as' => 'admin.routes.e.commerce.orders.payment.status.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_list'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/orders/payment/status'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.payment.status', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_list'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_create'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_delete'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.orders.payment.status.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_list'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.orders.payment.status.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_update'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.payment.status.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_delete'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.payment.status.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_force_delete'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.payment.status.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_list'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_update'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_delete'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.orders.payment.status.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_update'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.orders.payment.status.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_create'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.payment.status.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_force_delete'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiForceDelete']);
        });
    });
});
