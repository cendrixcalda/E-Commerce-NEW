<div class="dtHorizontalVerticalExampleWrapper">
    <?php echo form_open_multipart('', array('id' => 'add_brand')); ?>
        <table id="dtHorizontalVerticalExample" class="table table-hover table-bordered table-sm " cellspacing="0"
        width="100%">
            <thead>
                <tr>
                    <th class="no-sort">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input checkbox-all" id="tableDefaultCheck1" disabled>
                    <label class="custom-control-label fa-disabled" for="tableDefaultCheck1"></label>
                    </div>
                    </th>
                    <th>ID</th>
                    <th>Brand</th>
                    <th>Status</th>
                    <th class="no-sort"><button type="button" class="delete-all"><i class="fas fa-trash fa-disabled"></i></button></th>
                    <th class="no-sort"><button type="button" class="duplicate-all"><i class="fa fa-clone fa-disabled"></i></button></th>
                  </tr>
            </thead>
                <tr class="insert no-sort">
                    <td></td>
                    <td></td>
                    <td><div contenteditable spellcheck="false" class="editable" id="data1" name="brand"></div></td>
                    <td><select name="status" id="data2" class="dropdown">
                      <option value="Active">Active</option>
                      <option value="Disabled">Disabled</option>
                    </select></td>
                    <td><button type="submit" name="submit" value="add" class="add"><i class="fas fa-plus"></i></button></td>
                    <td></td>
                </tr>
        </table>
    </form>
</div>

<script>
$(document).ready(function () {

  var tr = $('.insert');
  var insertRow = tr.prop('outerHTML');
  tr.remove();

  var oldValue;

  var dataTable = $('#dtHorizontalVerticalExample').DataTable({
    scrollX: true,
    scrollY: 380,
    order: [[ 1, "asc" ]],
    ajax: {
      url: '<?php echo base_url(); ?>brands/showAllBrands',

      type: 'POST',
      data: { checker: "check" }
      },
      columnDefs: [{
        orderable: false,
        targets: 'no-sort'
      },
      {
        targets: [3],
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
        $('#dtHorizontalVerticalExample tbody').prepend(insertRow);
      }
    });

    $('#add_brand').on('submit', function(e){
      e.preventDefault();

      var brand = $('#data1').text();
      var status = $('#data2 option:selected').val();

      if(brand != '' && status != ''){
        $.ajax({
          url: "<?php echo base_url(); ?>brands/addBrand",
          method: "POST",
          data: {
            brand:brand, status:status
          },
          success: function(data){
            dataTable.ajax.reload();
          }
        });
      }
      else{
        alert('All Fields Required')
      }
    });

    function update_brand(id, column, value)
    {
      $.ajax({
        url: "<?php echo base_url(); ?>brands/updateBrand",
        method: "POST",
        data: {id:id, column:column, value:value},
        success:function(data)
        {
          reloadTable();
        }
      });
    }

    dataTable.on('focus', '.update', function() {
      oldValue = $(this).text();
    });

    dataTable.on('blur', '.update', function() {
      var value = $(this).text();

      if(value == ''){
        $(this).text(oldValue);
        alert("Please fill in this field");
      }

      if(value != oldValue && value != ''){
        var id = $(this).data("id");
        var column = $(this).data("column");
        update_brand(id, column, value);
      }
    });

    dataTable.on('change', '.updateDropdown', function(){
      var id = $(this).data("id");
      var column = $(this).data("column");
      var value = $('option:selected', this).val();

      update_brand(id, column, value);
    });


    // dataTable.on('click', '.delete', function () {
    //   var id = $(this).attr("id");
    //   if(confirm("Are you sure you want to remove this brand?")){
    //     $.ajax({
    //       url:"<?php echo base_url(); ?>brands/deleteBrand",
    //       method:"POST",
    //       data:{id:id},
    //       success:function(data){
    //         reloadTable();
    //       }
    //     });
    //   }
    // });

    // $('.delete-all').on('click', function(){
    //   if(confirm("Are you sure you want to remove selected brand/s?"))
    //   {
    //     var id = [];

    //     $('.checkbox:checked').each(function(i){
    //       id[i] = $(this).data('id');
    //     });

    //     $.ajax({
    //       url:"<?php echo base_url(); ?>brands/deleteAllBrand",
    //       method:"POST",
    //       data:{id:id},
    //       success:function(data){
    //         reloadTable();
    //       }
    //     });
    //   }
    // });

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
      $('input:checkbox').not(this).prop('checked', this.checked);

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