<html>

<head>
    <meta charset="utf-8">



    <link href="{{ asset('public/themes/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/themes/admin/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/themes/admin/css/plugins/timeline/timeline.css') }}" rel="stylesheet">
    <link href="{{ asset('public/themes/admin/css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('public/themes/admin/css/style.css') }}" rel="stylesheet">
    <style>
        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }


        img.hover {
            background: #DEF;
            box-shadow: 0 0 1em 0.5em #DEF;
        }


        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        table {
            font-size: 75%;
            width: 70%;
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 0.3em;
            position: relative;
        }

        th,
        td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #EEE;
            border-color: #BBB;
        }

        td {
            border-color: #DDD;
        }

        /* page */

        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
            width: 8.5in;
            background: #FFF;
            border-radius: 1px;
            
        }


        header:after {
            clear: both;
            content: "";
            display: table;
        }

        header h1 {
            background: #000;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        header address {
            float: left;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }

        header address p {
            margin: 0 0 0.25em;
            font-size: 12px;
        }

        header span,
        header img {
            display: block;
            float: right;
        }

        header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        }

        header img {
            max-height: 100%;
            max-width: 100%;
        }

        header input {
            cursor: pointer;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* article */

        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 1em;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        /* table meta & balance */

        table.meta,
        table.balance {
            float: right;
            width: 36%;
            font-size: 14px;
        }

        table.meta:after,
        table.balance:after {
            clear: both;
            content: "";
            display: table;
        }

        /* table meta */

        table.meta th {
            width: 60%;
            font-size: 14px;
        }

        table.meta td {
            width: 80%;
            font-size: 11px;
        }

        /* table items */

        table.inventory {
            clear: both;
            width: 100%;
            font-size: 10px;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
            font-size: 12px;
            border: 1px solid black;
        }

        table.inventory td {
            border: 1px solid black;
        }

        table.inventory td:nth-child(1) {
            width: 50%;
        }

        table.inventory td:nth-child(2) {
            width: 50%;
            
        }

        table.inventory td:nth-child(3) {
            width: 12%;
        }

        table.inventory td:nth-child(4) {
            width: 12%;
        }

        table.inventory td:nth-child(5) {
            width: 12%;
        }


        /* table balance */

        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        /* aside */

        aside h1 {
            border: none;
            border-width: 0 0 1px;
            margin: 0 0 1em;
        }

        aside h1 {
            border-color: #999;
            border-bottom-style: solid;
        }

        /* javascript */

        .add,
        .cut {
            border-width: 1px;
            display: block;
            font-size: .8rem;
            padding: 0.25em 0.5em;
            float: left;
            text-align: center;
            width: 0.6em;
        }

        .add,
        .cut {
            background: #9AF;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
            background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
            border-radius: 0.5em;
            border-color: #0076A3;
            color: #FFF;
            cursor: pointer;
            font-weight: bold;
            text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
        }

        .add {
            margin: -2.5em 0 0;
        }


        .cut {
            opacity: 0;
            position: absolute;
            top: 0;
            left: -1.5em;
        }

        .cut {
            -webkit-transition: opacity 100ms ease-in;
        }

        @page {
            size: A4;
            margin: 1cm; /* Adjust margins as needed */
        }

        .products td,th{
            border: 1px solid black;
        }

        
        .products th{
            font-weight: bold;
            text-align: center;
            font-size: 12px;
        }
        .address td,th{
            border: 1px solid black;
        }
        .address th{
            font-weight: bold;
            text-align: center;
            font-size: 12px;
        }


    </style>

    <script src="{{ asset('public/themes/admin/js/jquery-1.10.2.js') }}"></script>

</head>

<body>

    <div style="width: 700px; height: 1000px">

        <div>

            <div>
                <div style="border: 4px solid black;height:130px; text-align: center; box-sizing: border-box;margin-bottom:10px">
            
                    <div style='width: 15%; float: left; padding-left: 20px; padding-top: 10px;'>
                        <img alt="" style="float: left; height: 80px;" src="{{ asset('public/themes/admin/images/cylinderimage.png') }}">
                    </div>
            
                    <div style='width: 50%; float: left;'>
                        <h4 class="semibold nm"><strong> {{$company_detail->companyname}} </strong></h4>
                        <p>{{$company_detail->address}}, {{$company_detail->city}}</p>
                        <p> Phone- {{$company_detail->phone}}, Email- {{$company_detail->email}}</p>
                        <p> GSTIN- {{$company_detail->gst_number}}</p>
                    </div>
            
                    <div style='width: 15%; float: right; padding-top: 10px;'>
                        <img alt="" style="float: left; height: 80px;" src="{{ asset('public/themes/admin/images/indianoil.png') }}">
                    </div>
            
                </div>
            </div>
            

        <div>
        
        <div>
            <div>

                <table class="address" style="width:100%">

                    <tr>
                        <th colspan="2"><span>Invoice</span></th>
                    </tr>
                    <tr>
                        <td><span>Invoice No: {{$order->recipt_no}}</span></td>
                        <td><span>Connection type: {{$basic_detail->content_type}}</span></td>
                    </tr>
                    <tr>
                        <td><span id="prefix">Invoice date: {{$basic_detail->invoice_date}}</span></td>
                        <td><span id="prefix">SV No.: {{$basic_detail->sv_number}}</span></td>
                    </tr>
                    <tr>
                        <td><span id="prefix">Reverse Charge (Y/N): {{$basic_detail->reverse_charge}}</span></td>
                        <td><span id="prefix">Consumer No.: {{$basic_detail->consumer_number}}</span></td>
                    </tr>
                    <tr>
                        <td><span>State: U.K</span></td>
                        <td><span>Cust. GST : {{$basic_detail->user_gst}}</span></td>
                    </tr>

                    <tr>
                        <th><span>Billing Address</span></th>
                        <th><span>Shipping Address</span></th>
                    </tr>
                    <tr>
                        <td><span>Name: {{$billing_address->name}}</span></td>
                        <td><span>Name: {{$billing_address->name}}</span></td>
                    </tr>
                    <tr>
                        <td><span>Address: {{$billing_address->billing_address}}</span></td>
                        <td><span>Address: {{$billing_address->billing_address}}</span></td>
                    </tr>
                    <tr>
                        <td><span>Mobile Number:- {{$billing_address->number}}</span></td>
                        <td><span>Mobile Number:- {{$billing_address->number}}</span></td>
                    </tr>
                    <tr>
                        <td><span>State: {{$billing_address->state}}</span></td>
                        <td><span>State: {{$billing_address->state}}</span></td>
                    </tr>

                </table>

                <table class="products" style="width: 100%; border-collapse: collapse; margin-top:10px; margin-bottom:10px">
                    <thead>
                        <tr>
                            <th style='width: 29px;'><span>S.No.</span></th>
                            <th style='width: 100px;'><span>Product Name</span></th>
                            <th><span>HSN code</span></th>
                            <th><span>Qty</span></th>
                            <th><span>Rate</span></th>
                            <th><span>Amount</span></th>
                            <th><span>Taxable Value</span></th>
                            <th><span>CGST Rate</span></th>
                            <th><span>CGST Amount</span></th>
                            <th><span>SGST Rate</span></th>
                            <th><span>SGST Amount</span></th>
                            <th><span>Total</span></th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $count = 1;
                        @endphp
                        @foreach ($other_items as $item)
                            <tr class='even'>
                                <td style='text-align: center;'>{{$count++}}</td>
                                <td style='text-align: center;'>{{$item->product_name}}</td>
                                <td style='text-align: center;'></td>
                                <td style='text-align: center;'>{{$item->pro_qty}}</td>
                                <td style='text-align: center;'>{{$item->rate}}</td>
                                <td style='text-align: center;'>{{$item->rate*$item->pro_qty}}</td>
                                <td colspan="5" style="text-align:center;"> Exempted for GST</td>
                                <td style='text-align: center;'>{{$item->rate*$item->pro_qty}}</td>

                            </tr>
                        @endforeach

                        @for ($i = 0; $i < count($order_items); $i++)
                            <tr class="odd gradeX">
                                <td style='text-align: center;'>{{$count++}}</td>
                                <td style='text-align: center;'>{{$products[$i]->title}}</td>
                                <td style='text-align: center;'>{{$products[$i]->hsn_code}}</td>
                                <td style='text-align: center;'>{{$order_items[$i]->qty}}</td>
                                <td style='text-align: center;'>{{$order_items[$i]->rate}}</td>
                                <td style='text-align: center;'>{{$order_items[$i]->rate*$order_items[$i]->qty}}</td>
                                <td style='text-align: center;'>{{$order_items[$i]->rate*$order_items[$i]->qty}}</td>
                                <td style='text-align: center;'>{{$order_items[$i]->cgst_tax}}%</td>
                                <td style='text-align: center;'>{{$order_items[$i]->cgst_amount}}</td>
                                <td style='text-align: center;'>{{$order_items[$i]->sgst_tax}}%</td>
                                <td style='text-align: center;'>{{$order_items[$i]->sgst_amount}}</td>
                                <td style='text-align: center;'>{{$order_items[$i]->rate*$order_items[$i]->qty+$order_items[$i]->cgst_amount+$order_items[$i]->sgst_amount}}</td>

                            </tr>
                        @endfor

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Total</b></td>
                            <td style='text-align: center;'><b>{{$total_values['total_qty']}}</b></td>
                            <td style='text-align: center;'></td>
                            <td style='text-align: center;'><b>{{$total_values['total_amount_before_tax']}}</b></td>
                            <td style='text-align: center;'><b>{{$total_values['total_taxable_value']}}</b></td>
                            <td style='text-align: center;'></td>
                            <td style='text-align: center;'><b>{{$total_values['total_cgst']}}</b></td>
                            <td style='text-align: center;'></td>
                            <td style='text-align: center;'><b>{{$total_values['total_sgst']}}</b></td>
                            <td style='text-align: center;'><b>{{$total_values['total_amount_after_tax']}}</b></td>
                        </tr>
                    </tbody>
                </table>

                <div style="width:100%;height:190px;">
      
                        <table style="width:30%; float: left;">
                            <tr >
                                <td style="height: 40px">Schemes:</td>
                            </tr>
                            <tr>
                                <td style="height: 40px">Loan:</td>
                            </tr>
                            <tr>
                                <td style="height: 40px">Bank A/C: </td>
                            </tr>
                            <tr>
                                <td style="height: 40px">Terms & Conditions :</td>
                            </tr>
                        </table> 
       
                        <table style="width:68%; float: left;">
                            <tr>
                                <td style="height: 17px">Total Amount before Tax: {{$total_values['total_amount_before_tax']}}</td>
                            </tr>
                            <tr>
                                <td style="height: 17px">Add CGST: {{$total_values['total_cgst']}}</td>
                            </tr>
                            <tr>
                                <td style="height: 17px">Add SGST: {{$total_values['total_sgst']}}</td>
                            </tr>
                            <tr>
                                <td style="height: 17px">Total Tax Amount: {{$total_values['total_cgst'] + $total_values['total_sgst']}}</td>
                            </tr>
                            <tr>
                                <td style="height: 17px">Total Amount after Tax: {{$total_values['total_amount_after_tax']}}</td>
                            </tr>
                            <tr>
                                <td style="height: 17px">Discount: {{$order->discount}}</td>
                            </tr>
                            <tr>
                                <td style="height: 17px">Net amount payable: {{$total_values['total_amount_after_tax'] - $order->discount}}</td>
                            </tr>
                            <tr>
                                <td style="height: 16px">Amount in words: {{getStringOfAmount($total_values['total_amount_after_tax'] - $order->discount)}}</td>
                            </tr>
                        </table>               
                </div>

                <div style="width:100%; margin-top:10px;">
                    <table class="" style="width:24%; float:left;">
                        <tr style=" ">
                            <td style="height:80px">Authorised Signatory</td>
                        </tr>
                    </table>

                    <table class="" style="width:24%;  float:left;">
                        <tr>
                            <td style="height:80px">Common Seal</td>
                        </tr>
                    </table>

                    <table class="" style="width:24%;  float:left;">
                        <tr>
                            <td style="height:40px">Payment Type:-</td>
                        </tr>
                        <tr>
                            <td style="height:34px">{{$basic_detail->payment_mode}}</td>
                        </tr>
                    </table>
                    <table class="" style="width:24%; float:left;">
                        <tr>
                            <td style="height:80px">Customer's Signature</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

    </div>

</body>

</html>