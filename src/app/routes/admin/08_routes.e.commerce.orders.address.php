<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/orders/address', ['as' => 'admin.routes.e.commerce.orders.address.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_list'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/orders/address'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.address', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_list'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_create'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.orders.address.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_list'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.orders.address.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_update'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.address.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.address.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.address.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_list'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_update'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.orders.address.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_update'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.orders.address.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_create'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.address.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderAddressController@apiForceDelete']);
        });
    });
});
