<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/address', ['as' => 'admin.routes.e.commerce.address.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_list'], 'uses' => 'ecommerce\\HCECUserAddressController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/address'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.address', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_list'], 'uses' => 'ecommerce\\HCECUserAddressController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_create'], 'uses' => 'ecommerce\\HCECUserAddressController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_delete'], 'uses' => 'ecommerce\\HCECUserAddressController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.address.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_list'], 'uses' => 'ecommerce\\HCECUserAddressController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.address.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_update'], 'uses' => 'ecommerce\\HCECUserAddressController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.address.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_delete'], 'uses' => 'ecommerce\\HCECUserAddressController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.address.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_force_delete'], 'uses' => 'ecommerce\\HCECUserAddressController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.address.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_list'], 'uses' => 'ecommerce\\HCECUserAddressController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_update'], 'uses' => 'ecommerce\\HCECUserAddressController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_delete'], 'uses' => 'ecommerce\\HCECUserAddressController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.address.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_update'], 'uses' => 'ecommerce\\HCECUserAddressController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.address.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_create'], 'uses' => 'ecommerce\\HCECUserAddressController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.address.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_address_force_delete'], 'uses' => 'ecommerce\\HCECUserAddressController@apiForceDelete']);
        });
    });
});
