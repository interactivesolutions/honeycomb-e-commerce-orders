<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/address'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.address', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_list'], 'uses' => 'ecommerce\\HCECUserAddressController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_create'], 'uses' => 'ecommerce\\HCECUserAddressController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_delete'], 'uses' => 'ecommerce\\HCECUserAddressController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.address.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_list'], 'uses' => 'ecommerce\\HCECUserAddressController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.address.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_list'], 'uses' => 'ecommerce\\HCECUserAddressController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.address.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_update'], 'uses' => 'ecommerce\\HCECUserAddressController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.address.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_delete'], 'uses' => 'ecommerce\\HCECUserAddressController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.address.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_force_delete'], 'uses' => 'ecommerce\\HCECUserAddressController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.address.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_list'], 'uses' => 'ecommerce\\HCECUserAddressController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_update'], 'uses' => 'ecommerce\\HCECUserAddressController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_delete'], 'uses' => 'ecommerce\\HCECUserAddressController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.address.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_update'], 'uses' => 'ecommerce\\HCECUserAddressController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.address.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_create'], 'uses' => 'ecommerce\\HCECUserAddressController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.address.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_force_delete'], 'uses' => 'ecommerce\\HCECUserAddressController@apiForceDelete']);
        });
    });
});