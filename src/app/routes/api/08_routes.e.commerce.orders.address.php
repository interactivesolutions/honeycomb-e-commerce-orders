<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/orders/address'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.address', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_list'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_create'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.address.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_list'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.orders.address.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_list'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.orders.address.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_update'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.address.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.address.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.address.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_list'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_update'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.orders.address.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_update'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.orders.address.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_create'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.address.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiForceDelete']);
        });
    });
});