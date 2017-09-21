<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/orders/discount-codes', ['as' => 'admin.routes.e.commerce.orders.discount.codes.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/orders/discount-codes'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_create'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_update'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_update'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_update'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_create'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDiscountCodesController@apiForceDelete']);
        });
    });
});
