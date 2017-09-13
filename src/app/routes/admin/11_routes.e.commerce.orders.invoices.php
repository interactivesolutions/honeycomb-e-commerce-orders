<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/orders/invoices', ['as' => 'admin.routes.e.commerce.orders.invoices.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_list'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/orders/invoices'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.invoices', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_list'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_create'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.orders.invoices.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_list'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.orders.invoices.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_update'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.orders.invoices.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_create', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.invoices.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.orders.invoices.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_list'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_update'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.orders.invoices.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_update'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.orders.invoices.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_list', 'acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_create'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.orders.invoices.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_force_delete'], 'uses' => 'ecommerce\\orders\\HCECOrderInvoicesController@apiForceDelete']);
        });
    });
});
