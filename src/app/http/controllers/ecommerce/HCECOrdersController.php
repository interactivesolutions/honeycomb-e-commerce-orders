<?php

namespace interactivesolutions\honeycombecommerceorders\app\http\controllers\ecommerce;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderStates;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\payment\HCECOrderPaymentStatus;
use interactivesolutions\honeycombecommerceorders\app\services\HCOrderService;
use interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\HCECOrdersValidator;

class HCECOrdersController extends HCBaseController
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
            'title'       => trans('HCECommerceOrders::e_commerce_orders.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.orders'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-orders-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-orders-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

//        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_create') )
//            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

//        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_delete') )
//            $config['actions'][] = 'delete';

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
            'order_payment_status.title' => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.order_payment_status_id'),
            ],
            'order_state.title'          => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.order_state_id'),
            ],
            'user.email'                 => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.user_id'),
            ],
            'reference'                  => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.reference'),
            ],
            'payment'                    => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.payment'),
            ],
            'total_price'                => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.total_price'),
            ],
            'total_price_before_tax'     => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.total_price_before_tax'),
            ],
            'total_price_tax_amount'     => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.total_price_tax_amount'),
            ],
            'total_discounts'            => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.total_discounts'),
            ],
            'total_discounts_before_tax' => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.total_discounts_before_tax'),
            ],
            'total_discounts_tax_amount' => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.total_discounts_tax_amount'),
            ],
            'total_paid'                 => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.total_paid'),
            ],
            'total_paid_before_tax'      => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.total_paid_before_tax'),
            ],
            'total_paid_tax_amount'      => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.total_paid_tax_amount'),
            ],
            'order_note'                 => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders.order_note'),
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

        $record = HCECOrders::create(array_get($data, 'record'));

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
        $record = HCECOrders::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record', []));

        if( in_array(request('order_state_id'), ['shipped']) ) {
            $record->order_carriers()->update(array_get($data, 'carriers'));
        }

        (new HCOrderService())->handleUpdate(
            $record,
            array_get($data, 'handle.order_state_id'),
            array_get($data, 'handle.order_payment_status_id'),
            array_get($data, 'order_history.note')
        );

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
        HCECOrders::where('id', $id)->update(request()->all());

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
        HCECOrders::destroy($list);

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
        HCECOrders::onlyTrashed()->whereIn('id', $list)->forceDelete();

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
        HCECOrders::whereIn('id', $list)->restore();

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
        $with = ['order_state', 'order_payment_status', 'user'];

        if( $select == null )
            $select = HCECOrders::getFillableFields();

        $list = HCECOrders::with($with)->select($select)
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
            $query->where('order_state_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('user_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('reference', 'LIKE', '%' . $phrase . '%')
                ->orWhere('payment', 'LIKE', '%' . $phrase . '%')
                ->orWhere('total_price', 'LIKE', '%' . $phrase . '%')
                ->orWhere('total_price_before_tax', 'LIKE', '%' . $phrase . '%')
                ->orWhere('total_discounts', 'LIKE', '%' . $phrase . '%')
                ->orWhere('total_discounts_before_tax', 'LIKE', '%' . $phrase . '%')
                ->orWhere('total_paid', 'LIKE', '%' . $phrase . '%')
                ->orWhere('total_paid_before_tax', 'LIKE', '%' . $phrase . '%')
                ->orWhere('order_note', 'LIKE', '%' . $phrase . '%')->orWhereHas('user', function ($query) use ($phrase) {
                    $query->where('email', 'LIKE', '%' . $phrase . '%');
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
        (new HCECOrdersValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'handle.order_state_id', array_get($_data, 'order_state_id'));
        array_set($data, 'handle.order_payment_status_id', array_get($_data, 'order_payment_status_id'));

        array_set($data, 'record.user_id', array_get($_data, 'user_id'));
        array_set($data, 'record.reference', array_get($_data, 'reference'));
        array_set($data, 'record.payment', array_get($_data, 'payment'));
        array_set($data, 'record.total_price', array_get($_data, 'total_price'));
        array_set($data, 'record.total_price_before_tax', array_get($_data, 'total_price_before_tax'));
        array_set($data, 'record.total_price_tax_amount', array_get($_data, 'total_price_tax_amount'));
        array_set($data, 'record.total_discounts', array_get($_data, 'total_discounts'));
        array_set($data, 'record.total_discounts_before_tax', array_get($_data, 'total_discounts_before_tax'));
        array_set($data, 'record.total_discounts_tax_amount', array_get($_data, 'total_discounts_tax_amount'));

        array_set($data, 'record.total_paid', array_get($_data, 'total_paid'));
        array_set($data, 'record.total_paid_before_tax', array_get($_data, 'total_paid_before_tax'));
        array_set($data, 'record.total_paid_tax_amount', array_get($_data, 'total_paid_tax_amount'));

        array_set($data, 'record.order_note', array_get($_data, 'order_note'));

        array_set($data, 'order_history.note', array_get($_data, 'order_history_note'));

        array_set($data, 'carriers.tracking_number', array_get($_data, 'tracking_number'));

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
        $with = ['order_carriers'];

        $select = HCECOrders::getFillableFields();

        $record = HCECOrders::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        $record->tracking_number = array_get($record, 'order_carriers.tracking_number');

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

        $orderPaymentStatus = [
            'fieldID'   => 'order_payment_status_id',
            'type'      => 'dropDownList',
            'label'     => trans('HCECommerceOrders::e_commerce_orders_history.order_payment_status_id'),
            'options'   => HCECOrderPaymentStatus::select('id')->get()->toArray(),
            'showNodes' => ['title'],
        ];

        $orderStates = [
            'fieldID'   => 'order_state_id',
            'type'      => 'dropDownList',
            'label'     => trans('HCECommerceOrders::e_commerce_orders_history.order_state_id'),
            'options'   => HCECOrderStates::select('id')->get()->toArray(),
            'showNodes' => ['title'],
        ];

        $filters[] = addAllOptionToDropDownList($orderPaymentStatus);
        $filters[] = addAllOptionToDropDownList($orderStates);

        return $filters;
    }
}
