<?php

namespace interactivesolutions\honeycombecommerceorders\app\http\controllers\ecommerce\orders;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderAddress;
use interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\orders\HCECOrderAddressValidator;

/**
 * Class HCECOrderAddressController
 * @package interactivesolutions\honeycombecommerceorders\app\http\controllers\ecommerce\orders
 */
class HCECOrderAddressController extends HCBaseController
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
            'title'       => trans('HCECommerceOrders::e_commerce_orders_address.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.orders.address'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-orders-address-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-orders-address-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_orders_routes_e_commerce_orders_address_delete') )
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
            'order.reference' => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.order_id'),
            ],
            'updated_at' => [
                "type" => "text",
                "label" => trans('HCTranslations::core.updated'),
            ],
            'email'           => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.email'),
            ],
            'first_name'      => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.first_name'),
            ],
            'last_name'       => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.last_name'),
            ],
            'country'         => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.country'),
            ],
            'street_address'  => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.street_address'),
            ],
            'city'            => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.city'),
            ],
            'district'        => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.district'),
            ],
            'postal_code'     => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.postal_code'),
            ],
            'phone'           => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.phone'),
            ],
            'notes'           => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.notes'),
            ],
            'company_name'    => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.company_name'),
            ],
            'company_code'    => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.company_code'),
            ],
            'company_vat'     => [
                "type"  => "text",
                "label" => trans('HCECommerceOrders::e_commerce_orders_address.company_vat'),
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

        $record = HCECOrderAddress::create(array_get($data, 'record'));

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
        $record = HCECOrderAddress::findOrFail($id);

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
        HCECOrderAddress::where('id', $id)->update(request()->all());

        return $this->apiShow($id);
    }

    /**
     * Delete records table
     *
     * @param array $list
     * @return mixed
     * @throws \Exception
     */
    protected function __apiDestroy(array $list)
    {
        \DB::beginTransaction();

        try {
            HCECOrderAddress::whereIn('id', $list)->forceDelete();
        } catch ( \Exception $e ) {
            \DB::rollback();

            throw $e;
        }

        \DB::commit();

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
        HCECOrderAddress::onlyTrashed()->whereIn('id', $list)->forceDelete();

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
        HCECOrderAddress::whereIn('id', $list)->restore();

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
            $select = HCECOrderAddress::getFillableFields();

        $list = HCECOrderAddress::with($with)->select($select)
            ->addSelect('updated_at')
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
            $query->where('email', 'LIKE', '%' . $phrase . '%')
                ->orWhere('first_name', 'LIKE', '%' . $phrase . '%')
                ->orWhere('last_name', 'LIKE', '%' . $phrase . '%')
                ->orWhere('country', 'LIKE', '%' . $phrase . '%')
                ->orWhere('street_address', 'LIKE', '%' . $phrase . '%')
                ->orWhere('city', 'LIKE', '%' . $phrase . '%')
                ->orWhere('district', 'LIKE', '%' . $phrase . '%')
                ->orWhere('postal_code', 'LIKE', '%' . $phrase . '%')
                ->orWhere('phone', 'LIKE', '%' . $phrase . '%')
                ->orWhere('notes', 'LIKE', '%' . $phrase . '%');
        });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     * @throws \Exception
     */
    protected function getInputData()
    {
        (new HCECOrderAddressValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.order_id', array_get($_data, 'order_id'));
        array_set($data, 'record.email', array_get($_data, 'email'));
        array_set($data, 'record.first_name', array_get($_data, 'first_name'));
        array_set($data, 'record.last_name', array_get($_data, 'last_name'));
        array_set($data, 'record.country', array_get($_data, 'country'));
        array_set($data, 'record.street_address', array_get($_data, 'street_address'));
        array_set($data, 'record.city', array_get($_data, 'city'));
        array_set($data, 'record.district', array_get($_data, 'district'));
        array_set($data, 'record.postal_code', array_get($_data, 'postal_code'));
        array_set($data, 'record.phone', array_get($_data, 'phone'));
        array_set($data, 'record.notes', array_get($_data, 'notes'));
        array_set($data, 'record.company_name', array_get($_data, 'company_name'));
        array_set($data, 'record.company_code', array_get($_data, 'company_code'));
        array_set($data, 'record.company_vat', array_get($_data, 'company_vat'));

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

        $select = HCECOrderAddress::getFillableFields();

        $record = HCECOrderAddress::with($with)
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
