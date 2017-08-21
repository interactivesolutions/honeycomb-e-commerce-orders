<?php

namespace interactivesolutions\honeycombecommerceorders\app\http\controllers\ecommerce\carts;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\carts\HCECCartItems;
use interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\carts\HCECCartItemsValidator;

class HCECCartItemsController extends HCBaseController
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
            'title'       => trans('HCECommerceOrders::e_commerce_carts_items.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.carts.items'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-carts-items-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-carts-items-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

//        if (auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_create'))
//            $config['actions'][] = 'new';
//
//        if (auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_update'))
//        {
//            $config['actions'][] = 'update';
//            $config['actions'][] = 'restore';
//        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_carts_items_delete') )
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
            'cart_id'        => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_carts_items.cart_id'),
            ],
            'goods.translations.{lang}.label'       => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_carts_items.goods_id'),
            ],
            'combination_id' => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_carts_items.combination_id'),
            ],
            'amount'         => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_carts_items.amount'),
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

        $record = HCECCartItems::create(array_get($data, 'record'));

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
        $record = HCECCartItems::findOrFail($id);

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
        HCECCartItems::where('id', $id)->update(request()->all());

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
        HCECCartItems::destroy($list);

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
        HCECCartItems::onlyTrashed()->whereIn('id', $list)->forceDelete();

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
        HCECCartItems::whereIn('id', $list)->restore();

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
        $with = ['goods.translations'];

        if( $select == null )
            $select = HCECCartItems::getFillableFields();

        $list = HCECCartItems::with($with)->select($select)
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
            $query->where('cart_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('goods_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('combination_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('amount', 'LIKE', '%' . $phrase . '%');
        });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCECCartItemsValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.cart_id', array_get($_data, 'cart_id'));
        array_set($data, 'record.goods_id', array_get($_data, 'goods_id'));
        array_set($data, 'record.combination_id', array_get($_data, 'combination_id'));
        array_set($data, 'record.amount', array_get($_data, 'amount'));

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

        $select = HCECCartItems::getFillableFields();

        $record = HCECCartItems::with($with)
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
