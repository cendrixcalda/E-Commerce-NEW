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
<th>Customer ID</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Password</th>
<th>Email</th>
<th>Status</th>
<th class="no-sort"><button type="button" class="delete-all"><i class="fas fa-trash"></i></button></th>
<th class="no-sort"><button type="button" class="duplicate-all"><i class="fa fa-clone fa-disabled"></i></button></th>
</tr>
</thead>
</table>
</div>

<script>
$(document).ready(function () {

  var oldValue;
  window.prevFocus = $();

  var dataTable = $('#dtHorizontalVerticalExample').DataTable({
    scrollX: true,
    scrollY: 400,
    order: [[ 1, "asc" ]],
    ajax: {
      url: '<?php echo base_url(); ?>customers/showAllCustomers',

      type: 'POST',
      data: { checker: "check" }
      },
      columnDefs: [{
        orderable: false,
        targets: 'no-sort'
      },
      {
        targets: [6],
        render: function(data, type, full, meta){
          if(type === 'filter' || type === 'sort'){
            var api = new $.fn.dataTable.Api(meta.settings);
            var td = api.cell({row: meta.row, column: meta.col}).node();
            data = $('select, input', td).val();
          }
          return data;
        }
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

    function update_customer(id, column, value)
    {
      $.ajax({
        url: "<?php echo base_url(); ?>customers/updateCustomer",
        method: "POST",
        data: {id:id, column:column, value:value},
        success:function(data)
        {
            reloadTable();
        }
      });
    }

    dataTable.on('change', '.updateDropdown', function(){
      var id = $(this).data("id");
      var column = $(this).data("column");
      var value = $('option:selected', this).val();
      update_customer(id, column, value);
    });

    dataTable.on('click', '.delete', function () {
      var id = [];
      id[0] = $(this).attr("id");
      var column = "customerID";
      var affectedOrders = 0;
      $.ajax({
        url:"<?php echo base_url(); ?>orders/getAffectedOrders",
        method:"POST",
        data:{id:id, column:column},
        success:function(affectedOrders){
          if(affectedOrders <= 0){
            if(confirm("Are you sure you want to remove this customer?")){
              $.ajax({
                url:"<?php echo base_url(); ?>customers/deleteCustomer",
                method:"POST",
                data:{id:id},
                success:function(data){
                  reloadTable();
                }
              });
            }
          } else{
            alert("Action Denied!\n"+affectedOrders+" order/s will be affected once this customer is deleted.");
          }
        }
      });
    });

    $('.delete-all').on('click', function(){
      var id = [];
        $('.checkbox:checked').each(function(i){
          id[i] = $(this).data('id');
        });
      var column = "customerID";
      var affectedOrders = 0;
      $.ajax({
        url:"<?php echo base_url(); ?>orders/getAffectedOrders",
        method:"POST",
        data:{id:id, column:column},
        success:function(affectedOrders){
          if(affectedOrders <= 0){
            if(confirm("Are you sure you want to remove selected customer/s?")){
              $.ajax({
                url:"<?php echo base_url(); ?>customers/deleteCustomer",
                method:"POST",
                data:{id:id},
                success:function(data){
                  reloadTable();
                }
              });
            }
          } else{
            alert("Action Denied!\n"+affectedOrders+" order/s will be affected once selected customer/s is deleted.");
          }
        }
      });
    });

    dataTable.on('change', '.checkbox', function () {
      var selected = $('.checkbox:checked');

      if (selected.length == $('.checkbox').length) {
        $('.checkbox-all').prop('indeterminate', false);
        $('.checkbox-all').prop('checked', true);
        $('.delete-all').show( "slow");
        $('.duplicate-all').show( "slow");
      } else if(selected.length == 0){
        $('.checkbox-all').prop('indeterminate', false);
        $('.checkbox-all').prop('checked', false);
        $('.delete-all').hide( "slow");
        $('.duplicate-all').hide( "slow");
      } else if (selected.length > 0){
        $('.checkbox-all').prop('indeterminate', true);
        $('.delete-all').show( "slow");
        $('.duplicate-all').show( "slow");
      }
    });

    $(".checkbox-all").click(function(){
      $('input:checkbox').not(this).not('.not-checkbox').prop('checked', this.checked);

      if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('.delete-all').show( "slow");
        $('.duplicate-all').show( "slow");
      } else if($('.checkbox:checked').length == 0){
        $('.delete-all').hide( "slow");
        $('.duplicate-all').hide( "slow");
      }
    });

    function reloadTable(){
      $('.checkbox-all').prop('indeterminate', false);
      $('.checkbox-all').prop('checked', false);
      $('.delete-all').hide( "slow");
      $('.duplicate-all').hide( "slow");
      dataTable.ajax.reload();
    }


  });
  </script>