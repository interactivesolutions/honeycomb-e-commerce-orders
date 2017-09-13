<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/orders/invoices'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.invoices', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_list'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_create'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.invoices.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_list'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.orders.invoices.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_list'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.orders.invoices.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_update'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.invoices.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.invoices.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.orders.invoices.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_list'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_update'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.orders.invoices.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_update'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.orders.invoices.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_create'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.orders.invoices.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiForceDelete']);
        });
    });
});