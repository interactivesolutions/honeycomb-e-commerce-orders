<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/orders/payment/status'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.payment.status', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_list'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_create'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_delete'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.payment.status.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_list'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.orders.payment.status.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_list'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.orders.payment.status.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_update'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.payment.status.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_delete'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.payment.status.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_force_delete'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.payment.status.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_list'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_update'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_delete'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.orders.payment.status.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_update'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.orders.payment.status.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_create'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.payment.status.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_payment_status_force_delete'], 'uses' => 'ecommerce\\orders\\payment\\HCECOrderPaymentStatusController@apiForceDelete']);
        });
    });
});