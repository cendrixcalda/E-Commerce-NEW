<?php
  $accountTypeSession = $this->session->userdata('account_type');
  
  $disableRestore = ($accountTypeSession == 'User') ? 'fa-disabled' : '' ;
  $disableRestore1 = ($accountTypeSession == 'User') ? 'disabled-restore-all' : 'restore-all' ;
?>
<div class="dtHorizontalVerticalExampleWrapper">
    <?php echo form_open_multipart('', array('id' => 'add_color')); ?>
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
                    <th>Color ID</th>
                    <th>Color</th>
                    <th>Color Code</th>
                    <?php
                      if($accountTypeSession != 'User'){
                        echo '<th>Status</th>';
                      }
                    ?>
                    <th class="no-sort"><button type="button" class="delete-all"><i class="fas fa-trash"></i></button></th>
                    <th class="no-sort"><button type="button" class="<?php echo $disableRestore1 ?>"><i class="fas fa-trash-restore <?php echo $disableRestore ?>"></i></button></th>
                  </tr>
            </thead>
                <tr class="insert no-sort">
                    <td></td>
                    <td></td>
                    <td><div contenteditable spellcheck="false" class="editable" id="data1" name="color"></div></td>
                    <td><div contenteditable spellcheck="false" class="editable" id="data2" name="colorCode"></div></td>
                    <?php
                      if($accountTypeSession != 'User'){
                        echo '<td><div class="editable" name="status">Active</div></td>';
                      }
                    ?>
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
      url: '<?php echo base_url(); ?>colors/showAllColors',
      type: 'POST',
      data: { checker: "check" }
      },
      columnDefs: [{
        orderable: false,
        targets: 'no-sort'
      }]
    });
    $('.dataTables_length').addClass('bs-select');

    $('#dtHorizontalVerticalExample').dataTable().fnSettings().aoDrawCallback.push({
      "fn": function () {
        $('#dtHorizontalVerticalExample tbody').prepend(insertRow);
        <?php
          if($accountTypeSession == 'User'){
            echo 'var userRows = (dataTable.rows().count()-1);
                  if(userRows == 0){
                    $("#tableDefaultCheck1").prop("disabled", true);
                  } else{
                    $("#tableDefaultCheck1").prop("disabled", false);
                  }';
          }?>
        <?php
          if($accountTypeSession == 'Administrator'){
            echo 'var adminRows = $(".checkbox").length;
                  if(adminRows == 0){
                    $("#tableDefaultCheck1").prop("disabled", true);
                  } else{
                    $("#tableDefaultCheck1").prop("disabled", false);
                  }';
          }?>
      }
    });

    $('#add_color').on('submit', function(e){
      e.preventDefault();

      var color = $('#data1').text();
      var colorCode = $('#data2').text();
      var status = 'Active'

      if(color != '' && colorCode != '' && status != ''){
        $.ajax({
          url: "<?php echo base_url(); ?>colors/addColor",
          method: "POST",
          data: {
            color:color, colorCode:colorCode, status:status
          },
          success: function(data){
            reloadTable();
          }
        });
      }
      else{
        alert('All Fields Required')
      }
    });

    function update_color(id, column, value)
    {
      $.ajax({
        url: "<?php echo base_url(); ?>colors/updateColor",
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
        update_color(id, column, value);
      }
    });

    dataTable.on('click', '.delete', function () {
      var id = [];
      id[0] = $(this).attr("id");
      var column = "colorID";
      var affectedItems = 0;
      $.ajax({
        url:"<?php echo base_url(); ?>items/getAffectedItems",
        method:"POST",
        data:{id:id, column:column},
        success:function(affectedItems){
          if(affectedItems <= 0){
            <?php
              if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
                echo "msg = 'WARNING: This operation is irreversible, once deleted color can\'t be restored again.\\n\\nContinue deleting this color?';";
              } else{
                echo "msg = 'Are you sure you want to remove this color?';";
              }
            ?>
            if(confirm(msg)){
              $.ajax({
                url:"<?php echo base_url(); ?>colors/deleteColor",
                method:"POST",
                data:{id:id},
                success:function(data){
                  reloadTable();
                }
              });
            }
          } else{
            alert("Action Denied!\n"+affectedItems+" item/s will be affected once this data is deleted.");
          }
        }
      });
    });

    $('.delete-all').on('click', function(){
      var id = [];
      $('.checkbox:checked').each(function(i){
        id[i] = $(this).data('id');
      });
      var column = "colorID";
      var affectedItems = 0;
      $.ajax({
        url:"<?php echo base_url(); ?>items/getAffectedItems",
        method:"POST",
        data:{id:id, column:column},
        success:function(affectedItems){
          if(affectedItems <= 0){
            <?php
              if($accountTypeSession == 'Administrator' || $accountTypeSession == 'Super-Administrator'){
                echo "msg = 'WARNING: This operation is irreversible, once deleted color/s can\'t be restored again.\\n\\nContinue deleting selected color/s?';";
              } else{
                echo "msg = 'Are you sure you want to remove selected color/s?';";
              }
            ?>
            if(confirm(msg)){
              $.ajax({
                url:"<?php echo base_url(); ?>colors/deleteColor",
                method:"POST",
                data:{id:id},
                success:function(data){
                  reloadTable();
                }
              });
            }
          } else{
            alert("Action Denied!\n"+affectedItems+" item/s will be affected once selected data is deleted.");
          }
        }
      });
    });

    dataTable.on('click', '.restore', function () {
      if(confirm("Are you sure you want to restore this color?")){
        var id = [];
        id[0] = $(this).attr("id");

        $.ajax({
          url:"<?php echo base_url(); ?>colors/restoreColor",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    $('.restore-all').on('click', function(){
      if(confirm("Are you sure you want to restore selected color/s?")){
        var id = [];

        $('.checkbox:checked').each(function(i){
          id[i] = $(this).data('id');
        });

        $.ajax({
          url:"<?php echo base_url(); ?>colors/restoreColor",
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

      if ($('.checkbox:checked').length == $('.checkbox').length && $('.checkbox:checked').length != 0) {
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