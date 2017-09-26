<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/orders', ['as' => 'admin.routes.e.commerce.orders.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_list'], 'uses' => 'ecommerce\\HCECOrdersController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/orders'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_list'], 'uses' => 'ecommerce\\HCECOrdersController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_create'], 'uses' => 'ecommerce\\HCECOrdersController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_delete'], 'uses' => 'ecommerce\\HCECOrdersController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.orders.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_list'], 'uses' => 'ecommerce\\HCECOrdersController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.orders.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_update'], 'uses' => 'ecommerce\\HCECOrdersController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_delete'], 'uses' => 'ecommerce\\HCECOrdersController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_force_delete'], 'uses' => 'ecommerce\\HCECOrdersController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_list'], 'uses' => 'ecommerce\\HCECOrdersController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_update'], 'uses' => 'ecommerce\\HCECOrdersController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_delete'], 'uses' => 'ecommerce\\HCECOrdersController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.orders.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_update'], 'uses' => 'ecommerce\\HCECOrdersController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.orders.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_create'], 'uses' => 'ecommerce\\HCECOrdersController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_force_delete'], 'uses' => 'ecommerce\\HCECOrdersController@apiForceDelete']);
        });
    });
});
