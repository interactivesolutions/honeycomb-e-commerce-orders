<?php

namespace interactivesolutions\honeycombecommerceorders\app\http\controllers\ecommerce\orders;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECDiscountCodes;
use interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\orders\HCECDiscountCodesValidator;

class HCECDiscountCodesController extends HCBaseController
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
            'title'       => trans('HCECommerceOrders::e_commerce_orders_discount_codes.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.orders.discount.codes'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-orders-discount-codes-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-orders-discount-codes-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_discount_codes_delete') )
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
            'user.email'        => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.user_id'),
            ],
            'title'             => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.title'),
            ],
            'code'              => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.code'),
            ],
            'type'              => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.type'),
            ],
            'shipping_included' => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.shipping_included'),
            ],
            'free_shipping'     => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.free_shipping'),
            ],
            'amount'            => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.amount'),
            ],
            'total_available'   => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.total_available'),
            ],
            'valid_from'        => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.valid_from'),
            ],
            'valid_to'          => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.valid_to'),
            ],
            'minimum_amount'    => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_discount_codes.minimum_amount'),
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

        $record = HCECDiscountCodes::create(array_get($data, 'record'));

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
        $record = HCECDiscountCodes::findOrFail($id);

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
        HCECDiscountCodes::where('id', $id)->update(request()->all());

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
        HCECDiscountCodes::destroy($list);

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
        HCECDiscountCodes::onlyTrashed()->whereIn('id', $list)->forceDelete();

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
        HCECDiscountCodes::whereIn('id', $list)->restore();

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
        $with = [];

        if( $select == null )
            $select = HCECDiscountCodes::getFillableFields();

        $list = HCECDiscountCodes::with($with)->select($select)
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
            $query->where('user_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('title', 'LIKE', '%' . $phrase . '%')
                ->orWhere('code', 'LIKE', '%' . $phrase . '%')
                ->orWhere('type', 'LIKE', '%' . $phrase . '%')
                ->orWhere('shipping_included', 'LIKE', '%' . $phrase . '%')
                ->orWhere('free_shipping', 'LIKE', '%' . $phrase . '%')
                ->orWhere('amount', 'LIKE', '%' . $phrase . '%')
                ->orWhere('total_available', 'LIKE', '%' . $phrase . '%')
                ->orWhere('valid_from', 'LIKE', '%' . $phrase . '%')
                ->orWhere('valid_to', 'LIKE', '%' . $phrase . '%')
                ->orWhere('minimum_amount', 'LIKE', '%' . $phrase . '%');
        });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCECDiscountCodesValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.user_id', array_get($_data, 'user_id'));
        array_set($data, 'record.title', array_get($_data, 'title'));
        array_set($data, 'record.code', array_get($_data, 'code'));
        array_set($data, 'record.type', array_get($_data, 'type'));
        array_set($data, 'record.shipping_included', request()->has('shipping_included') ? '1' : '0');
        array_set($data, 'record.free_shipping', request()->has('free_shipping') ? '1' : '0');

        if( array_get($_data, 'type') == 'none' ) {
            array_set($data, 'record.amount', null);
        } else {
            array_set($data, 'record.amount', array_get($_data, 'amount'));
        }

        array_set($data, 'record.total_available', array_get($_data, 'total_available'));
        array_set($data, 'record.valid_from', array_get($_data, 'valid_from'));
        array_set($data, 'record.valid_to', array_get($_data, 'valid_to'));
        array_set($data, 'record.minimum_amount', array_get($_data, 'minimum_amount'));

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

        $select = HCECDiscountCodes::getFillableFields();

        $record = HCECDiscountCodes::with($with)
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
