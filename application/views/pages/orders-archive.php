<div class="dtHorizontalVerticalExampleWrapper">
<table id="dtHorizontalVerticalExample" class="table table-hover table-bordered table-sm " cellspacing="0"
width="100%">
<thead>
<tr>
<th class="no-sort">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input checkbox-all" id="tableDefaultCheck1">
<label class="custom-control-label" for="tableDefaultCheck1"></label>
</div>
</th>
<th>Order Number</th>
<th>Grand Unit</th>
<th>Grand Price</th>
<th>Payment Method</th>
<th>Shipping Address</th>
<th>Contact Number</th>
<th>Customer ID</th>
<th>Order Date</th>
<th class="no-sort">Order Time</th>
<th>Status</th>
<th class="no-sort"><button type="button" class="delete-all options"><i class="fas fa-trash"></i></button></th>
<th class="no-sort"><button type="button" class="restore-all"><i class="fas fa-trash-restore"></i></button></th>
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
      url: '<?php echo base_url(); ?>ordersArchive/showAllOrdersArchive',

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

        var rows = (dataTable.rows().count());
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

    dataTable.on('click', '.delete', function () {
        if(confirm("WARNING: This operation is irreversible, once deleted order can't be restored again.\n\nContinue deleting this order?")){
        var id = [];
        id[0] = $(this).attr("id");

        $.ajax({
          url:"<?php echo base_url(); ?>ordersArchive/deleteOrderArchive",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    $('.delete-all').on('click', function(){
        if(confirm("WARNING: This operation is irreversible, once deleted order/s can't be restored again.\n\nContinue deleting selected order/s?")){
        var id = [];

        $('.checkbox:checked').each(function(i){
          id[i] = $(this).data('id');
        });

        $.ajax({
          url:"<?php echo base_url(); ?>ordersArchive/deleteOrderArchive",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    dataTable.on('click', '.restore', function () {
      if(confirm("Are you sure you want to restore this order?")){
        var id = [];
        id[0] = $(this).attr("id");

        $.ajax({
          url:"<?php echo base_url(); ?>ordersArchive/restoreOrderArchive",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    $('.restore-all').on('click', function(){
      if(confirm("Are you sure you want to restore selected order/s?")){
        var id = [];

        $('.checkbox:checked').each(function(i){
          id[i] = $(this).data('id');
        });

        $.ajax({
          url:"<?php echo base_url(); ?>ordersArchive/restoreOrderArchive",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    dataTable.on('change', '.checkbox', function () {
      var selected = $('.checkbox:checked');

      if (selected.length == $('.checkbox').length) {
        $('.checkbox-all').prop('indeterminate', false);
        $('.checkbox-all').prop('checked', true);
        $('.delete-all').show( "slow");
        $('.restore-all').show( "slow");
      } else if(selected.length == 0){
        $('.checkbox-all').prop('indeterminate', false);
        $('.checkbox-all').prop('checked', false);
        $('.delete-all').hide( "slow");
        $('.restore-all').hide( "slow");
      } else if (selected.length > 0){
        $('.checkbox-all').prop('indeterminate', true);
        $('.delete-all').show( "slow");
        $('.restore-all').show( "slow");
      }
    });

    $(".checkbox-all").click(function(){
      $('input:checkbox').not(this).not('.not-checkbox').prop('checked', this.checked);

      if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('.delete-all').show( "slow");
        $('.restore-all').show( "slow");
      } else if($('.checkbox:checked').length == 0){
        $('.delete-all').hide( "slow");
        $('.restore-all').hide( "slow");
      }
    });

    function reloadTable(){
      $('.checkbox-all').prop('indeterminate', false);
      $('.checkbox-all').prop('checked', false);
      $('.delete-all').hide( "slow");
      $('.restore-all').hide( "slow");
      dataTable.ajax.reload();
    }
    
});
</script>