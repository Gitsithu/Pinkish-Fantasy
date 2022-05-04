<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () {
        // var f = document.getElementById("sale_type").value;

        // if(f == 1){
        var newRow = $("<tr>");
        var cols = "";


        cols += '<td><input type="text"  class="form-control dx"  name="size[]' + counter + '"></td>';
        cols += '<td><input type="color"  class="form-control dy" name="color[]' + counter + '"></td>';

        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
        // }
        // else{
        //     var newRow = $("<tr>");
        // var cols = "";


        // cols += '<td><input type="text"  class="form-control"  name="size[]' + counter + '"></td>';
        // cols += '<td><input type="color"  class="form-control" name="color[]' + counter + '"></td>';
        // cols += '<td style="display:none;" id="qty"><input type="number" class="form-control"   name="qty[]' + counter + '"/></td>';
        // cols += '<td><input type="text" class="form-control" name="price[]' + counter + '"/></td>';

        // cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        // newRow.append(cols);
        // $("table.order-list").append(newRow);
        // counter++;
        // }
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        counter -= 1
    });


});



function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}
</script>
