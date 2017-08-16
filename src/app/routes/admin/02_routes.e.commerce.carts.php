<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/carts', ['as' => 'admin.routes.e.commerce.carts.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_list'], 'uses' => 'ecommerce\\HCECCartsController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/carts'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.carts', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_list'], 'uses' => 'ecommerce\\HCECCartsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_create'], 'uses' => 'ecommerce\\HCECCartsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_delete'], 'uses' => 'ecommerce\\HCECCartsController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.carts.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_list'], 'uses' => 'ecommerce\\HCECCartsController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.carts.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_update'], 'uses' => 'ecommerce\\HCECCartsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.carts.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_delete'], 'uses' => 'ecommerce\\HCECCartsController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.carts.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_force_delete'], 'uses' => 'ecommerce\\HCECCartsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.carts.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_list'], 'uses' => 'ecommerce\\HCECCartsController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_update'], 'uses' => 'ecommerce\\HCECCartsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_delete'], 'uses' => 'ecommerce\\HCECCartsController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.carts.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_update'], 'uses' => 'ecommerce\\HCECCartsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.carts.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_create'], 'uses' => 'ecommerce\\HCECCartsController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.carts.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_force_delete'], 'uses' => 'ecommerce\\HCECCartsController@apiForceDelete']);
        });
    });
});
