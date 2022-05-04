@include('layouts.partial.header')
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel"><b>Cost Result</b></h6>
                <a href="/admin/calculator" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </a>
            </div>
            <div class="modal-body" style="padding:0px!important;opacity:1!important;">

                            <div class="table-responsive mb-4 mt-4">

                            <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="color: black;" class="text-center">Country Name</th>
                                            <th style="color: black;" class="text-center">Purchase Price</th>
                                            <th style="color: black;" class="text-center">Addditional Charges</th>
                                            <th style="color: black;" class="text-center">Cargo Fee</th>
                                            <th style="color: black;" class="text-center">Shipping Fee</th>
                                            <th style="color: black; padding-bottom:20px;" class="text-center">Result</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                         <tr>
                                            <td class="text-center"><b style="color:black;!important">{{ $country_name }}</b></td>
                                            <td class="text-center"><b style="color:black;!important">{{ $price }}</b></td>
                                            <td class="text-center"><b style="color:black;!important">{{ $additional_charges }}</b></td>
                                            <td class="text-center"><b style="color:black;!important">{{ $cargo}}</b></td>
                                            <td class="text-center"><b style="color:black;!important">{{ $shipping_fee}}</b></td>
                                            <td class="text-center"><b style="color:black;!important">{{ $sale_price }}</b></td>


                                         </tr>

                                    </tbody>

                                </table>

                            </div>

              {{-- modal body close tag  --}}
            </div>
            <div class="modal-footer">
                <a href="/admin/calculator" class="btn btn-outline-danger" id="c_paid"><i class="flaticon-cancel-12"></i> Cancel</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#exampleModal2').modal('show');
    });
</script>
 @include('layouts.partial.footer')
