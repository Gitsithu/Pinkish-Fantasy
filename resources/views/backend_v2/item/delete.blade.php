@include('layouts.partial.header')
<div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="account-settings-container layout-top-spacing">
                <form method="post" action="/admin/item_specification/delete">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">

                <div class="row">

                    <div class="col-md-12">
                        <button type="submit" onclick="change()" class="mt-4 btn btn-danger">Delete</button>
                    </div>


                </div>

                                                        <div class="row" id="cancel-row">


                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive">
                                <table class="multi-table table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="checkbox-column">
                                                <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                                    <input type="checkbox" class="new-control-input todochkbox" id="todoAll">
                                                    <span class="new-control-indicator"></span>
                                                </label>
                                            </th>

                                            <th style="color: black;" class="text-center">Size</th>
                                            <th style="color: black;" class="text-center">Color</th>
                                            <th style="color: black;" class="text-center">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($item_specifications as $item_specification)

                                        <tr>
                                        <td>
                                        <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                        <input type="checkbox" class="new-control-input todochkbox"  name="id[]" value="{{$item_specification->id}}" id="todo-1">
                                        <span class="new-control-indicator"></span>

                                      </td>


                                      <td class="text-center"><b>{{ $item_specification->size }}</b></td>
                                      <td class="text-center"><div style="border:1px solid;height:20px;background-color:{{ $item_specification->color }}">  </div>
                                            </td>
                                      <td class="text-center"><b>{{ $item_specification->qty }}</b></td>






                                        </tr>

                                      @endforeach

                                    </tbody>


                                </table>



                            </div>
                        </div>
                    </div>

                </div>
                                                                </form>
                                                                </div>
                                                </div>
                                            </div>

                                                        <script type="text/javascript">
  $(document).ready(function(){
    $('#select-all').click(function(){
      if(this.checked) {
        $(':checkbox').each(function(){
          this.checked = true;
        });
      }
      else {
        $(':checkbox').each(function(){
          this.checked = false;
        });
      }
    });
  });
</script>
<script>
    checkall('todoAll', 'todochkbox');
    $('[data-toggle="tooltip"]').tooltip()
</script>
<script>
    function change(){

        var data = [];
    $("input[name='id[]']:checked").each(function() {
        data.push($(this).val());
    });

    var d = typeof(data);

                    //window.location = "/" + type + "/destroy/" + data;
                    //route path to do deletion in controller
                    $("#frm_pre").attr('action',"/admin/item_specification/delete");
                    $("#frm_pre").attr('method', "POST");
                    $("#selected_checkboxes").val(data);
                    $("#frm_pre").submit();
                }


</script>

@include('layouts.partial.footer')
