<table>
    <thead>
        <tr>
            <th>Invoice Date
            </th>
            <th>Invoice No.
            </th>
            <th>Name</th>
            <th>Connection Type</th>
            <th>SV</th>

            @foreach ($products as $product)    
                <th>{{$product->title}}</th>           
            @endforeach

            <th>5% GST</th>
            <th>18% GST</th>
            <th>Discount</th>
            <th>Total Amount
            </th>

        </tr>
    </thead>
    <tbody >

        @php

            $smallestInvoiceDate = $merged_data->min(function ($item) {
                return strtotime($item->invice_date);
            });
            $smallestInvoiceDate = date('Y-m-d', $smallestInvoiceDate); 

            foreach($products as $product) 
            {
                $day_total[$product->id] = 0;               
            }
            $day_total['5gst']=0;
            $day_total['18gst']=0;
            $day_total['discount']=0;
            $day_total['amount']=0;

            foreach($products as $product) 
            {
                $grand_total[$product->id] = 0;               
            }
            $grand_total['5gst']=0;
            $grand_total['18gst']=0;
            $grand_total['discount']=0;
            $grand_total['amount']=0;

        @endphp

        @foreach ($merged_data as $row)

            @if ($smallestInvoiceDate != $row->invice_date)
                <tr>
                    <td colspan="5">Total</td>
                    @foreach ($products as $product)    
                        <td>{{$day_total[$product->id]}}</td>           
                    @endforeach  
                    <td>{{$day_total['5gst']}}</td>
                    <td>{{$day_total['18gst']}}</td>
                    <td>{{$day_total['discount']}}</td>
                    <td>{{$day_total['amount']}}</td>          
                </tr>

                @php
                    $smallestInvoiceDate = $row->invice_date;

                    foreach($products as $product) 
                    {
                        $grand_total[$product->id] += $day_total[$product->id];               
                    }
                    $grand_total['5gst'] += $day_total['5gst'];
                    $grand_total['18gst'] += $day_total['18gst'];
                    $grand_total['discount'] += $day_total['discount'];
                    $grand_total['amount'] += $day_total['amount'];

                    foreach($products as $product) 
                    {
                        $day_total[$product->id] = 0;               
                    }
                    $day_total['5gst']=0;
                    $day_total['18gst']=0;
                    $day_total['discount']=0;
                    $day_total['amount']=0;
                @endphp   

            @endif
     
            <tr role="row">
                <td>{{$row->invice_date}}
                </td>
                <td>{{$row->recipt_no}}
                </td>
                <td>{{$row->name}}</td>
                <td>{{$row->content_type}}</td>
                <td>{{$row->sv_number}}</td>

                @foreach ($products as $product)    
                    <td>{{is_order($product->id,$merged_order_products[$row->recipt_no])}}</td>      
                    @php
                        $day_total[$product->id] += intval(is_order($product->id,$merged_order_products[$row->recipt_no]));
                    @endphp
                @endforeach

                <td>{{is_5gst($merged_order_products[$row->recipt_no])}}</td>
                <td>{{is_18gst($merged_order_products[$row->recipt_no])}}</td>
                <td>{{$row->discount}}</td>
                <td>{{$row->totalprice - $row->discount}}
                @php
                    $day_total['5gst']+=intval(is_5gst($merged_order_products[$row->recipt_no]));
                    $day_total['18gst']+=intval(is_18gst($merged_order_products[$row->recipt_no]));
                    $day_total['discount']+=intval($row->discount);
                    $day_total['amount']+=$row->totalprice - $row->discount;
                @endphp
                </td>   

            </tr>
        @endforeach

        <tr>
            <td colspan="5">Total</td>
            @foreach ($products as $product)    
                <td>{{$day_total[$product->id]}}</td>           
            @endforeach  
            <td>{{$day_total['5gst']}}</td>
            <td>{{$day_total['18gst']}}</td>
            <td>{{$day_total['discount']}}</td>
            <td>{{$day_total['amount']}}</td> 
            
            @php
                foreach($products as $product) 
                {
                    $grand_total[$product->id] += $day_total[$product->id];               
                }
                $grand_total['5gst'] += $day_total['5gst'];
                $grand_total['18gst'] += $day_total['18gst'];
                $grand_total['discount'] += $day_total['discount'];
                $grand_total['amount'] += $day_total['amount'];
            @endphp
        </tr> 

        <tr></tr>
        <tr>
            <td colspan="5">Grand Total</td>
            @foreach ($products as $product)    
                <td>{{$grand_total[$product->id]}}</td>           
            @endforeach  
            <td>{{$grand_total['5gst']}}</td>
            <td>{{$grand_total['18gst']}}</td>
            <td>{{$grand_total['discount']}}</td>
            <td>{{$grand_total['amount']}}</td> 
        </tr> 
      
    </tbody>
</table>