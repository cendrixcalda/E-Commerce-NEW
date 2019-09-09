<div class="dtHorizontalVerticalExampleWrapper">
<table id="dtHorizontalVerticalExample" class="table table-hover table-bordered table-sm " cellspacing="0"
width="100%">
<thead>
<tr>
<th class="no-sort">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input checkbox-all" id="tableDefaultCheck1" disabled>
<label class="custom-control-label not-checkbox" for="tableDefaultCheck1"></label>
</div>
</th>
<th>Order Detail ID</th>
<th>Order Number</th>
<th>Item Number</th>
<th>Quantity</th>
<th>Price</th>
<th>Voucher Discount</th>
<th>Total Price</th>
<th>Date In Transit</th>
<th>Time In Transit</th>
<th>Date Delivered</th>
<th>Time Delivered</th>
<th>Date Cancelled</th>
<th>Time Cancelled</th>
<th>Status</th>
<th class="no-sort"><button type="button" class="delete-all disabled-delete-all"><i class="fas fa-trash fa-disabled"></i></button></th>
<th class="no-sort"><button type="button" class="restore-all disabled-restore-all"><i class="fas fa-trash-restore fa-disabled"></i></button></th>
</tr>
</thead>
</table>
</div>

<script>
$(document).ready(function () {
  var dataTable = $('#dtHorizontalVerticalExample').DataTable({
    scrollX: true,
    scrollY: 400,
    order: [[ 1, "asc" ]],
    ajax: {
      url: '<?php echo base_url(); ?>orderDetailsArchive/showAllOrderDetailsArchive',

      type: 'POST',
      data: { checker: "check" },
      },
      columnDefs: [{
        orderable: false,
        targets: 'no-sort'
      }]
    });
    $('.dataTables_length').addClass('bs-select');

    $('#dtHorizontalVerticalExample').dataTable().fnSettings().aoDrawCallback.push({
      "fn": function () {

        var rows = $(".checkbox").length;
        if(rows == 0){
          $("#tableDefaultCheck1").prop("disabled", true);
        } else{
          $("#tableDefaultCheck1").prop("disabled", false);
        }
      }
    });

    <?php
        if($this->uri->segment(3) != ""){
            $slug = $this->uri->segment(3);
            echo 'dataTable.search("'.$slug.'").draw();';
        }
    ?>

    function reloadTable(){
      dataTable.ajax.reload();
    }
    
});
</script>