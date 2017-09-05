<?php

namespace interactivesolutions\honeycombecommerceorders\app\http\controllers\ecommerce\orders;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderCarriers;
use interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\orders\HCECOrderCarriersValidator;

class HCECOrderCarriersController extends HCBaseController
{

    //TODO recordsPerPage setting

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $config = [
            'title'       => trans('HCECommerceOrders::e_commerce_orders_carriers.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.orders.carriers'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-orders-carriers-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-orders-carriers-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_carriers_delete') )
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters();

        return hcview('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader()
    {
        return [
            'order.reference'           => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.order_id'),
            ],
            'carrier.label'             => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.carrier_id'),
            ],
            'name'                      => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.name'),
            ],
            'weight'                    => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.weight'),
            ],
            'shipping_price'            => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.shipping_price'),
            ],
            'shipping_price_before_tax' => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.shipping_price_before_tax'),
            ],
            'shipping_tax_amount'       => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.shipping_tax_amount'),
            ],
            'tax_name'                  => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.tax_name'),
            ],
            'tax_value'                 => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.tax_value'),
            ],
            'user_note'                 => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.user_note'),
            ],
            'tracking_number'           => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_carriers.tracking_number'),
            ],
        ];
    }

    /**
     * Create item
     *
     * @return mixed
     */
    protected function __apiStore()
    {
        $data = $this->getInputData();

        $record = HCECOrderCarriers::create(array_get($data, 'record'));

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __apiUpdate(string $id)
    {
        $record = HCECOrderCarriers::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record', []));

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __apiUpdateStrict(string $id)
    {
        HCECOrderCarriers::where('id', $id)->update(request()->all());

        return $this->apiShow($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiDestroy(array $list)
    {
        HCECOrderCarriers::destroy($list);

        return hcSuccess();
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiForceDelete(array $list)
    {
        HCECOrderCarriers::onlyTrashed()->whereIn('id', $list)->forceDelete();

        return hcSuccess();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed
     */
    protected function __apiRestore(array $list)
    {
        HCECOrderCarriers::whereIn('id', $list)->restore();

        return hcSuccess();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    protected function createQuery(array $select = null)
    {
        $with = ['order', 'carrier'];

        if( $select == null )
            $select = HCECOrderCarriers::getFillableFields();

        $list = HCECOrderCarriers::with($with)->select($select)
            // add filters
            ->where(function ($query) use ($select) {
                $query = $this->getRequestParameters($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->search($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list;
    }

    /**
     * List search elements
     * @param Builder $query
     * @param string $phrase
     * @return Builder
     */
    protected function searchQuery(Builder $query, string $phrase)
    {
        return $query->where(function (Builder $query) use ($phrase) {
            $query->where('order_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('carrier_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('name', 'LIKE', '%' . $phrase . '%')
                ->orWhere('weight', 'LIKE', '%' . $phrase . '%')
                ->orWhere('tax_name', 'LIKE', '%' . $phrase . '%')
                ->orWhere('tax_value', 'LIKE', '%' . $phrase . '%')
                ->orWhere('user_note', 'LIKE', '%' . $phrase . '%')
                ->orWhere('tracking_number', 'LIKE', '%' . $phrase . '%')
                ->orWhereHas('order', function ($query) use ($phrase) {
                    $query->where('reference', 'LIKE', '%' . $phrase . '%');
                })->orWhereHas('carrier', function ($query) use ($phrase) {
                    $query->where('label', 'LIKE', '%' . $phrase . '%');
                });
        });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCECOrderCarriersValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.order_id', array_get($_data, 'order_id'));
        array_set($data, 'record.carrier_id', array_get($_data, 'carrier_id'));
        array_set($data, 'record.name', array_get($_data, 'name'));
        array_set($data, 'record.weight', array_get($_data, 'weight'));
        array_set($data, 'record.shipping_price', array_get($_data, 'shipping_price'));
        array_set($data, 'record.shipping_price_before_tax', array_get($_data, 'shipping_price_before_tax'));
        array_set($data, 'record.shipping_tax_amount', array_get($_data, 'shipping_tax_amount'));
        array_set($data, 'record.tax_name', array_get($_data, 'tax_name'));
        array_set($data, 'record.tax_value', array_get($_data, 'tax_value'));
        array_set($data, 'record.user_note', array_get($_data, 'user_note'));
        array_set($data, 'record.tracking_number', array_get($_data, 'tracking_number'));

        return makeEmptyNullable($data);
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function apiShow(string $id)
    {
        $with = [];

        $select = HCECOrderCarriers::getFillableFields();

        $record = HCECOrderCarriers::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        return $filters;
    }
}
