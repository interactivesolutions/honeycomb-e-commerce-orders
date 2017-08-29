<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/orders/details'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.details', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_create'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.details.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.orders.details.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.orders.details.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_update'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.details.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.details.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.details.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_update'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.orders.details.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_update'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.orders.details.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_create'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.details.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiForceDelete']);
        });
    });
});