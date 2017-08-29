<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/orders/states'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.states', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_list'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_create'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.states.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_list'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.orders.states.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_list'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.orders.states.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_update'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.states.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.states.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.states.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_list'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_update'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.orders.states.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_update'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.orders.states.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_create'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.states.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_states_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderStatesController@apiForceDelete']);
        });
    });
});