<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/orders/carriers'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.carriers', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_list'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_create'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.carriers.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_list'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.orders.carriers.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_list'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.orders.carriers.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_update'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.carriers.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.carriers.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.carriers.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_list'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_update'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.orders.carriers.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_update'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.orders.carriers.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_create'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.carriers.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderCarriersController@apiForceDelete']);
        });
    });
});