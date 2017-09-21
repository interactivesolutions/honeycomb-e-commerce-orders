<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/orders/discount-codes', ['as' => 'admin.routes.e.commerce.orders.discount.codes.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/orders/discount-codes'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_create'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_delete'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_update'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.discount.codes.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_delete'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_force_delete'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_update'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_delete'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_update'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_create'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.discount.codes.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_force_delete'], 'uses' => 'ecommerce\\orders\\HCECDiscountCodesController@apiForceDelete']);
        });
    });
});
