<?php

namespace interactivesolutions\honeycombecommerceorders\app\http\controllers\ecommerce\orders;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderInvoices;
use interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\orders\HCECOrderInvoicesValidator;

class HCECOrderInvoicesController extends HCBaseController
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
            'title'       => trans('HCECommerceOrders::e_commerce_orders_invoices.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.orders.invoices'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-orders-invoices-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-orders-invoices-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

//        if (auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_create'))
//            $config['actions'][] = 'new';
//
//        if (auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_update'))
//        {
//            $config['actions'][] = 'update';
//            $config['actions'][] = 'restore';
//        }
//
//        if (auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_invoices_delete'))
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
            'number'          => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_invoices.number'),
            ],
            'order.reference' => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_invoices.order_id'),
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

        $record = HCECOrderInvoices::create(array_get($data, 'record'));

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
        $record = HCECOrderInvoices::findOrFail($id);

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
        HCECOrderInvoices::where('id', $id)->update(request()->all());

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
        HCECOrderInvoices::destroy($list);

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
        HCECOrderInvoices::onlyTrashed()->whereIn('id', $list)->forceDelete();

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
        HCECOrderInvoices::whereIn('id', $list)->restore();

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
        $with = ['order'];

        if( $select == null )
            $select = HCECOrderInvoices::getFillableFields();

        $list = HCECOrderInvoices::with($with)->select($select)
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
            $query->where('number', 'LIKE', '%' . $phrase . '%')
                ->orWhere('order_id', 'LIKE', '%' . $phrase . '%')
                ->orWhereHas('order', function ($query) use ($phrase) {
                    $query->where('reference', 'LIKE', '%' . $phrase . '%');
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
        (new HCECOrderInvoicesValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.number', array_get($_data, 'number'));
        array_set($data, 'record.order_id', array_get($_data, 'order_id'));

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

        $select = HCECOrderInvoices::getFillableFields();

        $record = HCECOrderInvoices::with($with)
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
