<!-- <select id="chkveg" class="multi-select" multiple="multiple">
<option value="cheese">Cheese</option>
<option value="tomatoes">Tomatoes</option>
</select><br /><br />

<input type="button" id="btnget" value="Get Selected Values" /> -->

<div class="dtHorizontalVerticalExampleWrapper">
<?php echo form_open_multipart('', array('id' => 'add_item')); ?>
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
<th>ID</th>
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
<th class="no-sort"><button type="button" class="duplicate-all"><i class="fa fa-clone"></i></button></th>
</tr>

</thead>
<tr class="insert no-sort">
<td></td>
<td></td>
<td></td>
<td><div contenteditable spellcheck="false" class="editable" id="data1" name="name"></div></td>
<?php
  $optionBrand = '';
  foreach($brands as $brand){
    $optionBrand .= '<option value="'.$brand->brandID.'">'.$brand->brand.'</option>';
  }

  $optionCategory = '';
  foreach($categories as $category){
    $optionCategory .= '<option value="'.$category->categoryID.'">'.$category->category.'</option>';
  }

  $optionColor = '';
  foreach($colors as $color){
    $optionColor .= '<option value="'.$color->colorID.'">'.$color->color.'</option>';
  }

  $optionCountry = '';
  foreach($countries as $country){
    $optionCountry .= '<option value="'.$country->countryID.'">'.$country->country.'</option>';
  }

  $optionMaterial = '';
  foreach($materials as $material){
    $optionMaterial .= '<option value="'.$material->materialID.'">'.$material->material.'</option>';
  }

  $optionSize = '';
  foreach($sizes as $size){
    $optionSize .= '<option value="'.$size->sizeID.'">'.$size->size.'</option>';
  }
?>

<td><select name="brandID" id="data2" class="dropdown"><?php echo $optionBrand ?></select></td>
<td><select name="forGenders" id="data3" class="dropdown">
  <option value="None">None</option>
  <option value="Men">Men</option>
  <option value="Women">Women</option>
  <option value="Unisex">Unisex</option>
</select></td>
<td><select name="categoryID" id="data4" class="dropdown"><?php echo $optionCategory ?></select></td>
<td><div contenteditable spellcheck="false" class="editable price" id="data5" name="price"></div></td>
<td><div contenteditable spellcheck="false" class="editable salePercentage" id="data6" name="salePercentage"></div></td>
<td><div class="editable netPrice" id="data7" name="netPrice">0</div></td>
<td><div contenteditable spellcheck="false" class="editable stock" id="data8" name="stock"></div></td>
<td><select name="colorID" id="data9" class="dropdown"><?php echo $optionColor ?></select></td>
<td><select name="sizeID" id="data10" class="dropdown"><?php echo $optionSize ?></select></td>
<td><select name="materialID" id="data11" class="dropdown"><?php echo $optionMaterial ?></select></td>
<td><select name="countryID" id="data12" class="dropdown"><?php echo $optionCountry ?></select></td>
<td><div contenteditable spellcheck="false" class="editable" id="data13" name="description"></div></td>
<td><input type="date" id="data14" class="dropdown date" required="required" /></td>
<td><input type="file" name="userfile" class="image" id="data15" /></td>
<td class="options"><button type="submit" name="submit" value="add" class="add"><i class="fas fa-plus"></i></button></td>
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
  var priceColumn;
  var salePercentageColumn;
  var netPriceColumn;
  var price;
  var salePercentage;
  var netPrice;
  var saleInDecimal;
  var discountValue;

  var dataTable = $('#dtHorizontalVerticalExample').DataTable({
    scrollX: true,
    scrollY: 400,
    order: [[ 1, "asc" ]],
    ajax: {
      url: '<?php echo base_url(); ?>items/showAllItems',

      type: 'POST',
      data: { checker: "check" },
      },
      columnDefs: [{
        orderable: false,
        targets: 'no-sort'
      },
      {
        targets: [5],
        render: function(data, type, full, meta){
          if(type === 'filter' || type === 'sort'){
            var api = new $.fn.dataTable.Api(meta.settings);
            var td = api.cell({row: meta.row, column: meta.col}).node();
            data = $('select, input', td).val();
          }
          return data;
        }
      },
      {
        targets: [4, 6, 11, 12, 13, 14],
        render: function(data, type, full, meta){
          if(type === 'filter' || type === 'sort'){
            var api = new $.fn.dataTable.Api(meta.settings);
            var td = api.cell({row: meta.row, column: meta.col}).node();
            var $input = $('select, input', td);
            if($input.length && $input.is('select')){
              data = $('option:selected', $input).text();
            } else {
              data = $input.val();
            }
          }
          return data;
        }
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
        $('#dtHorizontalVerticalExample tbody').prepend(insertRow);

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
          var date = $(value, 'input').val();
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

    $('#add_item').on('submit', function(e){
      e.preventDefault();

      var name = $('#data1').text();
      var brand = $('#data2 option:selected').val();
      var forGenders = $('#data3 option:selected').val();
      var category = $('#data4 option:selected').val();
      var price = parseInt($('#data5').text());
      var salePercentage = parseInt($('#data6').text());
      var netPrice = $('#data7').text();
      var stock = $('#data8').text();
      var color = $('#data9 option:selected').val();
      var size = $('#data10 option:selected').val();
      var material = $('#data11 option:selected').val();
      var madeIn = $('#data12 option:selected').val();
      var description = $('#data13').text();
      var date = $('#data14').val();
      var image = document.getElementById("data15").files[0];
      
      var formData = new FormData();

      formData.append("name", name);
      formData.append("brand", brand);
      formData.append("forGenders", forGenders);
      formData.append("category", category);
      formData.append("price", price);
      formData.append("salePercentage", salePercentage);
      formData.append("netPrice", netPrice);
      formData.append("stock", stock);
      formData.append("color", color);
      formData.append("size", size);
      formData.append("material", material);
      formData.append("madeIn", madeIn);
      formData.append("description", description);
      formData.append("date", date);
      formData.append("userfile", image);

      if(name != '' && brand != '' && forGenders != '' && category != '' && price != '' && salePercentage != '' && netPrice != '' && stock != '' && color != '' && size != '' && material != '' && madeIn != '' && description != '' && date != '' && image !== undefined){
        $.ajax({
          url: "<?php echo base_url(); ?>items/addItem",
          method: "POST",
          data:formData,
          processData:false,
          contentType:false,
          success: function(data){
            reloadTable();
          }
        });
      }
      else{
        alert('All Fields Required')
      }
    });

    function update_item(id, column, value, name, category, gender, color, size)
    {
      $.ajax({
        url: "<?php echo base_url(); ?>items/updateItem",
        method: "POST",
        data: {id:id, column:column, value:value, name:name, category:category, gender:gender, color:color, size:size},
        success:function(data)
        {
          reloadTable();
        }
      });
    }

    function update_image(id, column, image)
    {
      var formData = new FormData();

      formData.append("id", id);
      formData.append("column", column);
      formData.append("userfile", image);

      $.ajax({
        url: "<?php echo base_url(); ?>items/updateImage",
        method: "POST",
        data:formData,
        processData:false,
        contentType:false,
        success:function(data)
        {
          reloadTable();
        }
      });
    }

    dataTable.on('focus', '.update', function() {
      oldValue = $(this).text();
    });

    dataTable.on('focus', '.updatePrice', function() {
      oldValue = $(this).text();
    });

    dataTable.on('focus', '.updateSalePercentage', function() {
      oldValue = $(this).text();
    });

    dataTable.on('keypress', '.price, .salePercentage, .stock',function(e) {
      if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
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
        var name = $(this).closest('tr').find('.name').text();
        var category = $(this).closest('tr').find('.category option:selected').val();
        var gender = $(this).closest('tr').find('.gender option:selected').val();
        var color = $(this).closest('tr').find('.color option:selected').val();
        var size = $(this).closest('tr').find('.size option:selected').val();

        update_item(id, column, value, name, category, gender, color, size);
      }
    });

    dataTable.on('blur', '.price', function() {
      var value = $(this).text();

      if(value != oldValue){
        netPriceColumn = $(this).closest('tr').find('.netPrice');
        salePercentageColumn = $(this).closest('tr').find('.salePercentage');

        salePercentage = parseInt(salePercentageColumn.text());

        if(value == ''){
          value = 0;
        }
        if(salePercentage == '' || isNaN(salePercentage)){
          salePercentage = 0;
        }
        price = parseInt(value);
        saleInDecimal = salePercentage / 100;
        discountValue = price * saleInDecimal;
        netPrice = price - discountValue;

        netPriceColumn.text(netPrice);
      }
    });

    dataTable.on('blur', '.salePercentage', function() {
      var value = $(this).text();

      if(value != oldValue){
        netPriceColumn = $(this).closest('tr').find('.netPrice');
        priceColumn = $(this).closest('tr').find('.price');

        price = parseInt(priceColumn.text());

        if(price == '' || isNaN(price)){
          price = 0;
        }
        if(value == '' || isNaN(value)){
          value = 0;
        }

        salePercentage= parseInt(value);
        saleInDecimal = salePercentage / 100;
        discountValue = price * saleInDecimal;
        netPrice = price - discountValue;

        netPriceColumn.text(netPrice);
      }
    });

    dataTable.on('blur', '.updatePrice', function() {
      var value = $(this).text();

      if(value != oldValue){
        var id = $(this).data("id");
        var column = $(this).data("column");
        update_item(id, column, price);

        id = $(netPriceColumn).data("id");
        column = $(netPriceColumn).data("column");
        update_item(id, column, netPrice);
      }
    });

    dataTable.on('blur', '.updateSalePercentage', function() {
      var value = $(this).text();

      if(value != oldValue){
        var id = $(this).data("id");
        var column = $(this).data("column");
        update_item(id, column, salePercentage);

        id = $(netPriceColumn).data("id");
        column = $(netPriceColumn).data("column");
        update_item(id, column, netPrice);
      }
    });

    dataTable.on('change', '.updateDropdown', function(){
      var id = $(this).data("id");
      var column = $(this).data("column");
      var value = $('option:selected', this).val();
      var name = $(this).closest('tr').find('.name').text();
      var category = $(this).closest('tr').find('.category option:selected').val();
      var gender = $(this).closest('tr').find('.gender option:selected').val();
      var color = $(this).closest('tr').find('.color option:selected').val();
      var size = $(this).closest('tr').find('.size option:selected').val();

      update_item(id, column, value, name, category, gender, color, size);
    });

    dataTable.on('change', '.updateDate', function(){
      var id = $(this).data("id");
      var column = $(this).data("column");
      var value = $(this).val();
      update_item(id, column, value);
    });

    dataTable.on('change', '.imageUpdate', function(){
      var id = $(this).data("id");
      var column = $(this).data("column");
      var image =  document.getElementById(id).files[0];
      update_image(id, column, image);
    });

    dataTable.on('click', '.delete', function () {
      if(confirm("Are you sure you want to remove this item?")){
        var id = [];
        id[0] = $(this).attr("id");

        $.ajax({
          url:"<?php echo base_url(); ?>items/deleteItem",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    $('.delete-all').on('click', function(){
      if(confirm("Are you sure you want to remove selected item/s?"))
      {
        var id = [];

        $('.checkbox:checked').each(function(i){
          id[i] = $(this).data('id');
        });

        $.ajax({
          url:"<?php echo base_url(); ?>items/deleteItem",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    dataTable.on('click', '.duplicate', function () {
      if(confirm("Are you sure you want to duplicate this item?")){
        var id = [];
        id[0] = $(this).attr("id");
        
        $.ajax({
          url:"<?php echo base_url(); ?>items/duplicateItem",
          method:"POST",
          data:{id:id},
          success:function(data){
            reloadTable();
          }
        });
      }
    });

    $('.duplicate-all').on('click', function(){
      if(confirm("Are you sure you want to duplicate selected item/s?")){
        var id = [];

        $('.checkbox:checked').each(function(i){
          id[i] = $(this).data('id');
        });

        $.ajax({
          url:"<?php echo base_url(); ?>items/duplicateItem",
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