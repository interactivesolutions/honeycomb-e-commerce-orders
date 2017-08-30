<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/orders/carriers', ['as' => 'admin.routes.e.commerce.orders.carriers.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_list'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/orders/carriers'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.carriers', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_list'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_create'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.orders.carriers.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_list'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.orders.carriers.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_update'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.carriers.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.carriers.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.carriers.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_list'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_update'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.orders.carriers.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_update'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.orders.carriers.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_create'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.carriers.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiForceDelete']);
        });
    });
});
