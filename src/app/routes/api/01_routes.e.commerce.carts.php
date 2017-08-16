<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/carts'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.carts', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_list'], 'uses' => 'ecommerce\\HCECCartsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_create'], 'uses' => 'ecommerce\\HCECCartsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_delete'], 'uses' => 'ecommerce\\HCECCartsController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.carts.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_list'], 'uses' => 'ecommerce\\HCECCartsController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.carts.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_list'], 'uses' => 'ecommerce\\HCECCartsController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.carts.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_update'], 'uses' => 'ecommerce\\HCECCartsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.carts.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_delete'], 'uses' => 'ecommerce\\HCECCartsController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.carts.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_force_delete'], 'uses' => 'ecommerce\\HCECCartsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.carts.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_list'], 'uses' => 'ecommerce\\HCECCartsController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_update'], 'uses' => 'ecommerce\\HCECCartsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_delete'], 'uses' => 'ecommerce\\HCECCartsController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.carts.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_update'], 'uses' => 'ecommerce\\HCECCartsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.carts.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_create'], 'uses' => 'ecommerce\\HCECCartsController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.carts.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_force_delete'], 'uses' => 'ecommerce\\HCECCartsController@apiForceDelete']);
        });
    });
});