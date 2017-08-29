<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/orders/states', ['as' => 'admin.routes.e.commerce.orders.states.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_list'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/orders/states'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.states', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_list'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_create'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.orders.states.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_list'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.orders.states.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_update'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.states.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.states.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.states.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_list'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_update'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.orders.states.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_update'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.orders.states.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_create'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.states.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiForceDelete']);
        });
    });
});
