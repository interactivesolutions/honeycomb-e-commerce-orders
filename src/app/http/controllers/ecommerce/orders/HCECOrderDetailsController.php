<?php

namespace interactivesolutions\honeycombecommerceorders\app\http\controllers\ecommerce\orders;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderDetails;
use interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\orders\HCECOrderDetailsValidator;

class HCECOrderDetailsController extends HCBaseController
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
            'title'       => trans('HCECommerceOrders::e_commerce_orders_details.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.orders.details'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-orders-details-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-orders-details-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_details_delete') )
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
            'order.reference'                => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.order_id'),
            ],
            'good.translations.{lang}.label' => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.good_id'),
            ],
            'combination_id'                 => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.combination_id'),
            ],
            'warehouse.name'                   => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.warehouse_id'),
            ],
            'tax_name'                       => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.tax_name'),
            ],
            'tax_value'                      => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.tax_value'),
            ],
            'amount'                         => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.amount'),
            ],
            'reference'                      => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.reference'),
            ],
            'name'                           => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.name'),
            ],
            'price'                          => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.price'),
            ],
            'price_before_tax'               => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.price_before_tax'),
            ],
            'total_price'                    => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.total_price'),
            ],
            'total_price_before_tax'         => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_details.total_price_before_tax'),
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

        $record = HCECOrderDetails::create(array_get($data, 'record'));

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
        $record = HCECOrderDetails::findOrFail($id);

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
        HCECOrderDetails::where('id', $id)->update(request()->all());

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
        HCECOrderDetails::destroy($list);

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
        HCECOrderDetails::onlyTrashed()->whereIn('id', $list)->forceDelete();

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
        HCECOrderDetails::whereIn('id', $list)->restore();

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
        $with = ['good.translations', 'warehouse', 'order'];

        if( $select == null )
            $select = HCECOrderDetails::getFillableFields();

        $list = HCECOrderDetails::with($with)->select($select)
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
                ->orWhere('good_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('combination_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('warehouse_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('tax_name', 'LIKE', '%' . $phrase . '%')
                ->orWhere('tax_value', 'LIKE', '%' . $phrase . '%')
                ->orWhere('amount', 'LIKE', '%' . $phrase . '%')
                ->orWhere('reference', 'LIKE', '%' . $phrase . '%')
                ->orWhere('name', 'LIKE', '%' . $phrase . '%')
                ->orWhere('price', 'LIKE', '%' . $phrase . '%')
                ->orWhere('price_before_tax', 'LIKE', '%' . $phrase . '%')
                ->orWhere('total_price', 'LIKE', '%' . $phrase . '%')
                ->orWhere('total_price_before_tax', 'LIKE', '%' . $phrase . '%');
        });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCECOrderDetailsValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.order_id', array_get($_data, 'order_id'));
        array_set($data, 'record.good_id', array_get($_data, 'good_id'));
        array_set($data, 'record.combination_id', array_get($_data, 'combination_id'));
        array_set($data, 'record.warehouse_id', array_get($_data, 'warehouse_id'));
        array_set($data, 'record.tax_name', array_get($_data, 'tax_name'));
        array_set($data, 'record.tax_value', array_get($_data, 'tax_value'));
        array_set($data, 'record.amount', array_get($_data, 'amount'));
        array_set($data, 'record.reference', array_get($_data, 'reference'));
        array_set($data, 'record.name', array_get($_data, 'name'));
        array_set($data, 'record.price', array_get($_data, 'price'));
        array_set($data, 'record.price_before_tax', array_get($_data, 'price_before_tax'));
        array_set($data, 'record.total_price', array_get($_data, 'total_price'));
        array_set($data, 'record.total_price_before_tax', array_get($_data, 'total_price_before_tax'));

        return $data;
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

        $select = HCECOrderDetails::getFillableFields();

        $record = HCECOrderDetails::with($with)
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
