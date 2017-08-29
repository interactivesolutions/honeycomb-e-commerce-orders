<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/orders/history'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.history', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_list'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_create'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.history.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_list'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.orders.history.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_list'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.orders.history.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_update'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.history.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.history.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.history.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_list'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_update'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.orders.history.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_update'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.orders.history.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_create'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.history.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiForceDelete']);
        });
    });
});