@extends('HCCoreUI::admin.layout')

@if ( isset( $config['title'] ) &&  ! empty($config['title']))
    @section('content-header',  $config['title'] )
@endif

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ trans('HCECommerceOrders::e_commerce_orders.order_date') }}</span>
                            <span class="info-box-number">{{ $config['order']->created_at }}</span>
                            <span class="info-box-number">{{ trans('HCTranslations::core.weekday.' . strtolower($config['order']->created_at->format('l'))) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-eur"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ trans('HCECommerceOrders::e_commerce_orders.total_price') }}</span>
                            <span class="info-box-number">{{ hcprice()->round($config['order']->total_price) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-product-hunt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ trans('HCECommerceOrders::e_commerce_orders_details.products') }}</span>
                            <span class="info-box-number">{{ $config['order']->details->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('HCECommerceOrders::e_commerce_orders.order') }}
                                <small>{{ $config['order']->reference }}</small>
                            </h3>
                            <div class="box-tools pull-right">
                                <a href="#" class="btn btn-box-tool" title="Invoice">
                                    <i class="fa fa-print"></i>
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ trans('HCECommerceOrders::e_commerce_orders.payment_status') }}</h5>
                                        @if($config['order']->order_payment_status_id == 'payment-accepted')
                                            <span class="description-text">
                                                <span class="label label-success">
                                                    {{ $config['order']->order_payment_status->title }}
                                                </span>
                                            </span>
                                        @else
                                            <span class="description-text">{{ $config['order']->order_payment_status->title }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ trans('HCECommerceOrders::e_commerce_orders.state') }}</h5>
                                        <span class="description-text">{{ $config['order']->order_state->title  }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <dl class="dl-horizontal" style="padding-top: 10px">
                                        <div>
                                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders.reference') }}</dt>
                                            <dd>{{ $config['order']->reference }}</dd>
                                        </div>
                                        <div>
                                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders.payment') }}</dt>
                                            <dd>{{ $config['order']->payment }}</dd>
                                        </div>
                                        <div>
                                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders.total_price') }}</dt>
                                            <dd>{{ hcprice()->round($config['order']->total_price) }}</dd>
                                        </div>
                                        <div>
                                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders.total_discounts') }}</dt>
                                            <dd>{{ hcprice()->round($config['order']->total_discounts) }}</dd>
                                        </div>
                                        <div>
                                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders.total_paid') }}</dt>
                                            <dd>{{ hcprice()->round($config['order']->total_total_paid) }}</dd>
                                        </div>
                                        <div>
                                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders.total_unit_price') }}</dt>
                                            <dd>{{ hcprice()->round($config['order']->total_unit_price) }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Užsakymo istorija</h3>
                        </div>
                        <div class="box-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('HCECommerceOrders::e_commerce_orders_carriers.shipping_info') }}</h3>
                        </div>
                        <div class="box-body">

                            <div class="description-block">
                                <h5 class="description-header">{{ $config['order']->order_carriers->name  }}</h5>
                            </div>

                            <dl class="dl-horizontal">

                                <dt>{{ trans('HCECommerceOrders::e_commerce_orders_carriers.tracking_number') }}</dt>
                                <dd>{{ $config['order']->order_carriers->tracking_number }}</dd>

                                <dt>{{ trans('HCECommerceOrders::e_commerce_orders_carriers.shipping_address') }}</dt>
                                <dd>
                                    {{ $config['order']->order_address->street_address }}
                                    , {{ $config['order']->order_address->city }}
                                    , LT-{{ $config['order']->order_address->postal_code }}
                                </dd>

                                <dt>{{ trans('HCECommerceOrders::e_commerce_orders_carriers.shipping_price') }}</dt>
                                <dd>{{ $config['order']->order_carriers->shipping_price }}</dd>

                                @if($config['order']->order_carriers->tax_name)
                                    <dt>{{ trans('HCECommerceOrders::e_commerce_orders_carriers.tax_name') }}</dt>
                                    <dd>{{ $config['order']->order_carriers->tax_name }}</dd>

                                    <dt>{{ trans('HCECommerceOrders::e_commerce_orders_carriers.tax_value') }}</dt>
                                    <dd>{{ $config['order']->order_carriers->tax_value }}</dd>
                                @endif

                                @if($config['order']->order_carriers->user_note)
                                    <dt>{{ trans('HCECommerceOrders::e_commerce_orders_carriers.note') }}</dt>
                                    <dd>{{ $config['order']->order_carriers->user_note }}</dd>
                                @endif
                            </dl>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Kliento informacija</h3>
                        </div>
                        <div class="box-body">

                            <dl class="dl-horizontal">
                                <dt>{{ trans('HCECommerceOrders::e_commerce_orders_address.full_name') }}</dt>
                                <dd>
                                    {{ $config['order']->order_address->first_name }}
                                    {{ $config['order']->order_address->last_name }}
                                </dd>

                                <dt>{{ trans('HCECommerceOrders::e_commerce_orders_address.email') }}</dt>
                                <dd>{{ $config['order']->order_address->email }}</dd>

                                <dt>{{ trans('HCECommerceOrders::e_commerce_orders_address.phone') }}</dt>
                                <dd>{{ $config['order']->order_address->phone }}</dd>

                                <dt>{{ trans('HCECommerceOrders::e_commerce_orders_address.page_title') }}</dt>
                                <dd>
                                    {{ $config['order']->order_address->street_address }},
                                    {{ $config['order']->order_address->city }}
                                    , LT-{{ $config['order']->order_address->postal_code }}
                                </dd>

                                @if($config['order']->order_address->company_name)
                                    <dt>{{ trans('HCECommerceOrders::e_commerce_orders_address.company_name') }}</dt>
                                    <dd>{{ $config['order']->order_address->company_name }}</dd>

                                    <dt>{{ trans('HCECommerceOrders::e_commerce_orders_address.company_code') }}</dt>
                                    <dd>{{ $config['order']->order_address->company_code }}</dd>

                                    @if($config['order']->order_address->company_vat)
                                        <dt>{{ trans('HCECommerceOrders::e_commerce_orders_address.company_vat') }}</dt>
                                        <dd>{{ $config['order']->order_address->company_vat }}</dd>
                                    @endif
                                @endif

                                @if($config['order']->order_address->notes)
                                    <dt>{{ trans('HCECommerceOrders::e_commerce_orders_address.notes') }}</dt>
                                    <dd>{{ $config['order']->order_address->notes }}</dd>
                                @endif
                            </dl>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        @if($config['order']->order_discount_code)
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('HCECommerceOrders::e_commerce_orders_discount_codes.discount_code') }}</h3>
                    </div>
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders_discount_codes.title') }}</dt>
                            <dd>{{ $config['order']->order_discount_code->title }}</dd>

                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders_discount_codes.code') }}</dt>
                            <dd>{{ $config['order']->order_discount_code->code }}</dd>

                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders_discount_codes.type') }}</dt>
                            <dd>{{ trans('HCECommerceOrders::e_commerce_orders_discount_codes.types.' . $config['order']->order_discount_code->type) }}</dd>

                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders_discount_codes.amount') }}</dt>
                            <dd>{{ $config['order']->order_discount_code->amount }}</dd>

                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders_discount_codes.shipping_included') }}</dt>
                            <dd>{{ $config['order']->order_discount_code->shipping_included }}</dd>

                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders_discount_codes.free_shipping') }}</dt>
                            <dd>{{ $config['order']->order_discount_code->free_shipping }}</dd>

                            <dt>{{ trans('HCECommerceOrders::e_commerce_orders_discount_codes.discount_text') }}</dt>
                            <dd>{{ $config['order']->order_discount_code->discountText() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header no-border">
                    <h3 class="box-title">{{ trans('HCECommerceOrders::e_commerce_orders_details.products') }}</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-condensed table-hover">
                        <tr>
                            <th>
                                {{ trans('HCECommerceOrders::e_commerce_orders_details.name') }}
                            </th>
                            <th>
                                {{ trans('HCECommerceOrders::e_commerce_orders_details.reference') }}
                            </th>
                            <th>
                                {{ trans('HCECommerceOrders::e_commerce_orders_details.warehouse_id') }}
                            </th>
                            <th>
                                {{ trans('HCECommerceOrders::e_commerce_orders_details.price') }}
                            </th>
                            <th>
                                {{ trans('HCECommerceOrders::e_commerce_orders_details.amount') }}
                            </th>
                            <th>
                                {{ trans('HCECommerceOrders::e_commerce_orders_details.total_price') }}
                            </th>
                        </tr>

                        @foreach($config['order']->details as $detail)
                            <tr>
                                <td>{{ $detail->name }}</td>
                                <td>{{ $detail->reference }}</td>
                                <td>{{ $detail->warehouse->name }}</td>
                                @if($detail->discounts)
                                    <td>
                                        {{ hcprice()->round($detail->price) }}
                                        <div style="color: #666666;opacity: .7;text-decoration: line-through;font-style: italic;">
                                            {{ hcprice()->round($detail->unit_price) }}
                                        </div>
                                    </td>
                                @else
                                    <td>{{ hcprice()->round($detail->price) }}</td>
                                @endif
                                <td>{{ $detail->amount }}</td>
                                <td>{{ hcprice()->round($detail->total_price) }}</td>
                            </tr>
                        @endforeach

                        <tr class="success">
                            <td>
                                {{ trans('HCECommerceOrders::e_commerce_orders_carriers.shipping') }}
                                <small>({{ $config['order']->order_carriers->name }})</small>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ hcprice()->round($config['order']->order_carriers->shipping_price) }}</td>
                            <td>{{ hcprice()->round($config['order']->order_carriers->shipping_price) }}</td>
                        </tr>

                        @if($config['order']->order_discount_code)
                            <tr class="success">
                                <td colspan="6">
                                    <strong>
                                        {{ $config['order']->order_discount_code->title }}:
                                    </strong>
                                    <i>
                                        {{ $config['order']->order_discount_code->discountText() }}
                                    </i>
                                </td>
                            </tr>
                        @endif

                        <tr class="success">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-bold">
                                {{ trans('HCECommerceOrders::e_commerce_orders.total_price') }}
                            </td>
                            <td class="text-bold">
                                {{ hcprice()->round($config['order']->total_price) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')

@endsection
