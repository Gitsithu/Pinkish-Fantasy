<table>


    <tr>
        <td colspan="12" style="background-color: #f5a8ae;color:black; text-align:center;border-bottom:1px solid white;"><b>Order Report</b></td>
    </tr>


    <tr>
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">User Name</th>
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Item Code</th>
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Item Image</th>
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Order Date</th>
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Quantity</th>
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Order Status</th>

    </tr>


                                        @foreach ($orders as $order)

                                        <tr>
                                        <?php $path = public_path(); ?>

                                            <td colspan="2" style="text-align:center;height:2px;vertical-align:center;">{{ $order->name }}</td>
                                            <td colspan="2" style="text-align:center;vertical-align:center;">{{ $order->item_code}}</td>
                                            <td colspan="2" style="text-align:center;vertical-align:center;"><img src="{{$path}}{{$order->image_url1}}" width="60" height="60"></td>
                                            <td colspan="2" style="text-align:center;vertical-align:center;">{{ $order->order_date}}</td>
                                            <td colspan="2" style="text-align:center;vertical-align:center;">{{ $order->total_quantity}}</td>


                                       
                                             <td colspan="2" style="text-align:center;vertical-align:center;">
                                             @if($order->sale_type == 0 && $order->payment_status == 0)
                                             <span  style="border:2px dashed #f5a8ae!important;color:#f5a8ae;padding:4px!important;font-weight:bold;border-radius:3px;">Open</span>
                                             @else
                                            @if($order->preorder_status == 2)
                                                <span  style="border:2px dashed #E2A03F!important;color:#E2A03F;padding:4px!important;font-weight:bold;border-radius:3px;">Preorderd</span>
                                            @elseif($order->preorder_status == 1)
                                                <span style="border:2px dashed #E7515A!important;color:#E7515A;padding:4px!important;font-weight:bold;border-radius:3px;">To preorder</span>
                                            @elseif($order->preorder_status == 3)
                                                <span style="border:2px dashed #2195F1!important;color:#2195F1;padding:4px!important;font-weight:bold;border-radius:3px;">Received</span>
                                            @else
                                                <span style="border:2px dashed #8DBF42!important;color: #8DBF42;padding:4px!important;font-weight:bold;border-radius:3px;">Delivered</span>
                                            @endif
                                            @endif
                                            </td>
                                      </tr>
                                     @endforeach


</table>