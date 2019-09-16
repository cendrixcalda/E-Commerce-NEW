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
<th>Item ID</th>
<th>SKU</th>
<th>Name</th>
<th>Brand</th>
<th>For Genders</th>
<th>Category</th>
<th>Price</th>
<th>Sale Percentage</th>
<th>Net Price</th>
<th>Stock</th>
<th>Color</th>
<th>Size</th>
<th>Material</th>
<th>Made In</th>
<th>Description</th>
<th>Date</th>
<th>Image</th>
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
      url: '<?php echo base_url(); ?>itemsArchive/showAllItemsArchive',

      type: 'POST',
      data: { checker: "check" },
      },
      columnDefs: [{
        orderable: false,
        targets: 'no-sort'
      },
      {
        type: 'size-range',
        targets: 12
      },
      {
        type: 'extract-date',
        targets: 16
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

    jQuery.extend( jQuery.fn.dataTableExt.oSort, {
      "size-range-pre": function ( a ) {
        var sizeArr = ['None', 'Extra Extra Small', 'Extra Small', 'Small', 'Medium', 'Large', 'Extra Large', 'Extra Extra Large'];

        var a = a.replace('<div class="editable">','');
        var a = a.replace('</div>','');
        
        return sizeArr.indexOf(a);
      },
      "size-range-asc": function ( a, b ) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
      },
      "size-range-desc": function ( a, b ) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
      }
    } );

    jQuery.extend(jQuery.fn.dataTableExt.oSort, {
      "extract-date-pre": function(value) {
          var date = $(value, 'input').text();
          date = date.split('-');
          return Date.parse(date[1] + '/' + date[2] + '/' + date[0]);
      },
      "extract-date-asc": function(a, b) {
          return ((a < b) ? -1 : ((a > b) ? 1 : 0));
      },
      "extract-date-desc": function(a, b) {
          return ((a < b) ? 1 : ((a > b) ? -1 : 0));
      }
  });

    dataTable.on('click', '.delete', function () {
      var id = [];
      id[0] = $(this).attr("id");

      if(confirm("WARNING: This operation is irreversible, once deleted item can't be restored again.\n\nContinue deleting this item?")){
        $.ajax({
          url:"<?php echo base_url(); ?>itemsArchive/deleteItemArchive",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    $('.delete-all').click(function(){
      if(confirm("WARNING: This operation is irreversible, once deleted item/s can't be restored again.\n\nContinue deleting selected item?")){
        var id = [];
        $('.checkbox:checked').each(function(i){
          id[i] = $(this).data('id');
        });
      
        $.ajax({
          url:"<?php echo base_url(); ?>itemsArchive/deleteItemArchive",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    dataTable.on('click', '.restore', function () {
      if(confirm("Are you sure you want to restore this item?")){
        var id = [];
        id[0] = $(this).attr("id");

        $.ajax({
          url:"<?php echo base_url(); ?>itemsArchive/restoreItemArchive",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    $('.restore-all').on('click', function(){
      if(confirm("Are you sure you want to restore selected item/s?")){
        var id = [];

        $('.checkbox:checked').each(function(i){
          id[i] = $(this).data('id');
        });

        $.ajax({
          url:"<?php echo base_url(); ?>itemsArchive/restoreItemArchive",
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
      $('input:checkbox').not(this).prop('checked', this.checked);

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