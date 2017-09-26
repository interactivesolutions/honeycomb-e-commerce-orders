<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $order->reference }}</title>
</head>
<style type="text/css">
    /*html, body {*/
        /*margin: 0;*/
        /*height: 100%;*/
        /*font-size: 12px;*/
        /*line-height: 15px;*/
        /*font-family: "DejaVu Serif";*/
    /*}*/

    /*.header {*/
        /*height: 60px;*/
        /*padding-top: 20px;*/
        /*padding-bottom: 45px;*/
        /*text-align: center;*/
    /*}*/

    /*.invoice {*/
        /*width: 600px;*/
        /*margin: 0 auto;*/
    /*}*/

    /*.header .logo {*/
        /*text-align: center;*/
        /*border-bottom: 1px solid #bbb5b5;*/
        /*padding-bottom: 15px;*/
    /*}*/

    /*.status {*/
        /*text-align: center;*/
        /*margin: 25px 0;*/
    /*}*/

    /*.status .number {*/
        /*padding: 5px 0;*/
    /*}*/

    /*.buyer, .seller {*/
        /*width: 50%;*/
        /*float: left;*/
    /*}*/

    /*.clear {*/
        /*clear: both;*/
    /*}*/

    /*.order-list {*/
        /*margin: 25px 0 25px 0;*/
    /*}*/

    /*.order-list-header div {*/
        /*float: left;*/
    /*}*/

    /*.total-field {*/
        /*border-top: 1px solid black;*/
        /*font-weight: bold;*/
    /*}*/

    /*.price_words {*/
        /*font-style: italic;*/
    /*}*/

    /*.footer {*/
        /*color: #686868;*/
        /*border-top: 1px solid #bbb5b5;*/
        /*padding-top: 15px;*/
        /*position: absolute;*/
        /*bottom: 0;*/
        /*text-align: center;*/
        /*width: 600px;*/
    /*}*/

    /*.inline-block {*/
        /*display: inline-block;*/
        /*vertical-align: middle;*/
    /*}*/

    /*.additional-padding {*/
        /*padding: 0 5px;*/
    /*}*/

    /*.original-price {*/
        /*text-decoration: line-through;*/
        /*font-style: italic;*/
    /*}*/
</style>

<body>
Implement logic in your front end
{{--<div class="content">--}}
    {{--<div class="invoice">--}}
        {{--<div class="header">--}}
            {{--@if((request()->segment(2) == 'invoice' || request()->segment(2) == 'saskaita') && is_null(request('pdf')))--}}
                {{--<a href="?pdf">PDF</a>--}}
            {{--@endif--}}
            {{--<div class="logo">--}}
                {{--<img src="{{ asset('project/images/logo_small.png') }}" width="200"/>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="status">--}}
            {{--@if($order->order_invoice)--}}
                {{--<div><strong>{{ trans('project.orders.invoice') }}</strong></div>--}}
                {{--<div class="number">--}}
                    {{--{!! trans('project.orders.invoice_number', ['number' => str_pad($order->order_invoice->number, 6, '0', STR_PAD_LEFT)]) !!}--}}
                {{--</div>--}}
            {{--@else--}}
                {{--<div><strong>{{ trans('project.orders.early_invoice') }}</strong></div>--}}
                {{--<div class="number"></div>--}}
            {{--@endif--}}
            {{--<div>{{ $order->created_at->format('Y-m-d') }}</div>--}}
        {{--</div>--}}
        {{--<div class="order-header">--}}
            {{--<div class="seller">--}}
                {{--<div><strong>{{ trans('project.orders.seller') }}: DONATAS ČERNIUS</strong></div>--}}
                {{--<div>Asmens kodas: 38709140151</div>--}}
                {{--<div>IV vykdymo pažymos numeris: 743501</div>--}}
                {{--<div>Adresas: Pušyno g. 55-2, Giraitės km.,</div>--}}
                {{--<div>Kauno raj., LT-54310</div>--}}
                {{--<div>Sąskaita: LT36 7300 0101 0357 1352</div>--}}
                {{--<div>Bankas: „Swedbank” AB</div>--}}
            {{--</div>--}}
            {{--<div class="buyer">--}}
                {{--<div>--}}
                    {{--<strong>--}}
                        {{--{{ trans('project.orders.buyer') }}--}}
                        {{--: {{ $order->order_address->first_name }} {{ $order->order_address->last_name }}--}}
                    {{--</strong>--}}
                {{--</div>--}}

                {{--<div></div>--}}
                {{--<div>--}}
                    {{--{{ trans('project.orders.address') }}: {{ $order->order_address->street_address }},--}}
                    {{--{{ $order->order_address->city }}, LT-{{ $order->order_address->postal_code }}--}}
                {{--</div>--}}

                {{--<div>{{ trans('project.orders.phone') }}: {{ $order->order_address->phone }}</div>--}}
                {{--<div>{{ trans('project.orders.email') }}: {{ $order->order_address->email }}</div>--}}

                {{--@if($order->order_address->company_name)--}}
                    {{--<br/>--}}
                    {{--<div>--}}
                        {{--{{ trans('project.orders.company_name') }}:--}}
                        {{--<strong>{{ $order->order_address->company_name }}</strong>--}}
                    {{--</div>--}}
                    {{--<div>{{ trans('project.orders.company_code') }}: {{ $order->order_address->company_code }}</div>--}}

                    {{--@if($order->order_address->company_vat)--}}
                        {{--<div>{{ trans('project.orders.vat') }}: {{ $order->order_address->company_vat }}</div>--}}
                    {{--@endif--}}
                    {{--<br/>--}}
                {{--@endif--}}

                {{--<div><strong>{{trans('project.orders.order_reference')}}</strong>: {{ $order->reference }}</div>--}}

            {{--</div>--}}
            {{--<div class="clear"></div>--}}
        {{--</div>--}}
        {{--<div class="order-list">--}}
            {{--<table width="100%">--}}
                {{--<tr style="background-color:#ecf0f5">--}}
                    {{--<td align="left"><strong>{{ trans('project.orders.name') }}</strong></td>--}}
                    {{--<td align="center"><strong>{{ trans('project.orders.unit') }}</strong></td>--}}
                    {{--<td align="center"><strong>{{ trans('project.orders.amount') }}</strong></td>--}}
                    {{--<td align="center"><strong>{{ trans('project.orders.price') }}</strong></td>--}}
                    {{--<td align="right"><strong>{{ trans('project.orders.total') }}</strong></td>--}}
                {{--</tr>--}}

                {{--@foreach($order->details as $detail)--}}
                    {{--<tr>--}}
                        {{--<td align="left">{{ $detail->name }}</td>--}}
                        {{--<td align="center">vnt.</td>--}}
                        {{--<td align="center">{{ $detail->amount }}</td>--}}
                        {{--@if($detail->discounts)--}}
                            {{--<td align="center">--}}
                                {{--{{ hcprice()->inLt($detail->price) }}--}}
                                {{--<div class="original-price">{{ hcprice()->inLt($detail->unit_price) }}</div>--}}
                            {{--</td>--}}
                        {{--@else--}}
                            {{--<td align="center">{{ hcprice()->inLt($detail->price) }}</td>--}}
                        {{--@endif--}}
                        {{--<td align="right">{{ hcprice()->inLt($detail->total_price) }}</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}

                {{--<tr>--}}
                    {{--<td align="left">{{ trans('project.orders.shipping') }}--}}
                        {{--<small>({{ $order->order_carriers->name }})</small>--}}
                    {{--</td>--}}
                    {{--<td align="center"></td>--}}
                    {{--<td align="center"></td>--}}
                    {{--<td align="center">{{ hcprice()->inLt($order->order_carriers->shipping_price) }}</td>--}}
                    {{--<td align="right">--}}
                        {{--{{ hcprice()->inLt($order->order_carriers->shipping_price) }}--}}
                    {{--</td>--}}
                {{--</tr>--}}

                {{--@if($order->order_discount_code)--}}
                    {{--<tr>--}}
                        {{--<td align="right" colspan="5" class="no-bold-td" style="padding: 5px; 0">--}}
                            {{--<strong>--}}
                                {{--{{ $order->order_discount_code->title }}:--}}
                            {{--</strong>--}}
                            {{--<i>--}}
                                {{--{{ $order->order_discount_code->discountText() }}--}}
                            {{--</i>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endif--}}

                {{--<tr>--}}
                    {{--<td align="left"></td>--}}
                    {{--<td align="center"></td>--}}
                    {{--<td align="center"></td>--}}
                    {{--<td align="center" class="total-field">--}}
                        {{--{{ trans('project.orders.total_sum') }}--}}
                    {{--</td>--}}
                    {{--<td align="right" class="total-field">--}}
                        {{--{{ hcprice()->inLt($order->total_price) }}--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</div>--}}

        {{--<div>{{ trans('project.orders.price_in_words') }}:</div>--}}
        {{--<div class="price_words">--}}
            {{--{{ hcprice()->invoicePriceInLtWords($order->total_price) }}--}}
        {{--</div>--}}
        {{--<br/>--}}
        {{--<div><strong>{{ trans('project.orders.invoice_author') }}</strong>: </div>--}}
        {{--<br/>--}}
        {{--<div><strong>{{ trans('project.orders.invoice_receiver') }}</strong>:</div>--}}
    {{--</div>--}}
{{--</div>--}}

</body>
</html>