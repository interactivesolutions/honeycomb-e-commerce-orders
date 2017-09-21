<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/orders/discount-codes'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_create'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_delete'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_update'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_delete'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_force_delete'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_update'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_delete'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_update'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_create'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_force_delete'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiForceDelete']);
        });
    });
});