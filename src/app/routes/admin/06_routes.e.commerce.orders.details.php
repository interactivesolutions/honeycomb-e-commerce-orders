<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/orders/details', ['as' => 'admin.routes.e.commerce.orders.details.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/orders/details'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.details', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_create'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.orders.details.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.orders.details.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_update'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.details.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.details.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.details.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_list'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_update'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.orders.details.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_update'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.orders.details.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_create'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.details.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderDetailsController@apiForceDelete']);
        });
    });
});
