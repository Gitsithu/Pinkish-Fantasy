<table>


    <tr>
        <td colspan="12" style="background-color: #f5a8ae;color:black; text-align:center;border-bottom:1px solid white;"><b>Instock Report</b></td>
    </tr>


    <tr>


                                            
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Item Code</th>
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Item Image</th>
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Size</th>
                                            
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Color</th>
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Quantity</th>
                                            <th style="color: black;background-color:#f5a8ae;text-align:center;"colspan="2">Status</th>

    </tr>


                                        @foreach ($items as $item)

                                        <tr>
                                        <?php $path = public_path(); ?>

                                            <td colspan="2" style="text-align:center;height:2px;vertical-align:center;">{{ $item->item_code }}</td>
                                            
                                            <td colspan="2" style="text-align:center;vertical-align:center;"><img src="{{$path}}{{$item->image_url1}}" width="60" height="60"></td>
                                            <td colspan="2" style="text-align:center;vertical-align:center;">{{ $item->size}}</td>
                                            <td colspan="2" style="text-align:center;vertical-align:center;background-color:{{ $item->color }}"></td>
                                            <td colspan="2" style="text-align:center;vertical-align:center;">{{ $item->qty}}</td>


                                       
                                            
                                                @if($item->status == 1)
                                                <td colspan="2" style="text-align:center;vertical-align:center;">Active</td>
                                                @elseif($item->status == 0 || $item->status == 3)
                                                <td colspan="2" style="text-align:center;vertical-align:center;">Archive</td>
                                                @endif
                                                
                                      </tr>
                                     @endforeach


</table>