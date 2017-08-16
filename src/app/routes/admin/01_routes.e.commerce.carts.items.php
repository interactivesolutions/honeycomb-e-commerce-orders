<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/carts/items', ['as' => 'admin.routes.e.commerce.carts.items.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_list'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/carts/items'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.carts.items', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_list'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_create'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_delete'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.carts.items.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_list'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.carts.items.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_update'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.carts.items.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_delete'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.carts.items.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_force_delete'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.carts.items.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_list'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_update'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_delete'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.carts.items.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_update'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.carts.items.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_create'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.carts.items.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_force_delete'], 'uses' => 'ecommerce\\carts\\HCECCartItemsController@apiForceDelete']);
        });
    });
});
