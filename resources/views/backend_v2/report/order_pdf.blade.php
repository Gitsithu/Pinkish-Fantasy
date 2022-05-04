<div class="container">
        <h1>Order list</h1>
        <table border="1" cellpadding="10" width="100%" style="margin-bottom: 100px;">
            <tr>
                                            <th width="14%" style="text-align:center;background-color:#f5a8ae;color: black;font-size:12px;">User Name</th>
                                            <th style="text-align:center;background-color:#f5a8ae;color: black;font-size:12px;" width="14%">Item Code</th>
                                            <th style="text-align:center;background-color:#f5a8ae;color: black;font-size:12px;" width="14%">Item Image</th>
                                            <th style="text-align:center;background-color:#f5a8ae;color: black;font-size:12px;" width="14%">Order Date</th>
                                            <th style="text-align:center;background-color:#f5a8ae;color: black;font-size:12px;" width="14%">Quantity</th>
                                            <th style="text-align:center;background-color:#f5a8ae;color: black;font-size:12px;" width="14%">Order Status</th>
                
            </tr>
                                        @foreach ($orders as $order)

                                        <tr>
                                        
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->item_code}}</td>
                                            <td><img src="{{$order->image_url1}}" width="50px" height="50px;"></td>
                                            <td>{{ $order->order_date}}</td>
                                            <td>{{ $order->total_quantity}}</td>


                                            

                                            @if($order->sale_type == 0 && $order->payment_status == 0)
                                            <td>Open</td>
                                              @else
                                              @if($order->preorder_status == 2)
                                            <td>Preorderd</td>
                                            @elseif($order->preorder_status == 1)
                                            <td>To preorder</td>                                   
                                            @elseif($order->preorder_status == 3)
                                            <td>Received</td>                                   
                                            @else
                                            <td>Delivered</td>
                                            @endif
                                             @endif
                                           
                                      </tr>      
                                     @endforeach
                                     
            {{-- <tr>
                <td width="84%" colspan="6" align="center">Total</td>
                <td width="14%" align="right">{{ $total }}</td>
            </tr> --}}
        </table>
    </div>