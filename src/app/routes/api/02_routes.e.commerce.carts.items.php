<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/carts/items'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.carts.items', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_list'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_create'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_delete'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.carts.items.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_list'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.carts.items.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_list'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.carts.items.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_update'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.carts.items.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_delete'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.carts.items.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_force_delete'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.carts.items.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_list'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_update'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_delete'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.carts.items.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_update'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.carts.items.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_create'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.carts.items.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_force_delete'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiForceDelete']);
        });
    });
});