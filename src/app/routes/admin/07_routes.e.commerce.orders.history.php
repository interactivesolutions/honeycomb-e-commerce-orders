<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/orders/history', ['as' => 'admin.routes.e.commerce.orders.history.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_list'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/orders/history'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.history', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_list'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_create'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.orders.history.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_list'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.orders.history.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_update'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.history.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.history.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.history.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_list'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_update'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.orders.history.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_update'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.orders.history.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_create'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.history.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_history_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderHistoryController@apiForceDelete']);
        });
    });
});
