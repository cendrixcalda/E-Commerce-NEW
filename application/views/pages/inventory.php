<div class="dtHorizontalVerticalExampleWrapper">
<form method="post" id="add_item">
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
<th>Name</th>
<th>Brand</th>
<th>For Genders</th>
<th>Category</th>
<th>Price</th>
<th>Sale Percentage</th>
<th>Net Price</th>
<th>Stock</th>
<th>Color</th>
<th>Made In</th>
<th>Materials</th>
<th>Sizes</th>
<th>Date</th>
<th>Image</th>
<th class="no-sort"><button type="button" class="delete-all"><i class="fas fa-trash"></i></button></th>
</tr>

</thead>
<!-- <tbody id="tableBody"> -->
<tr class="insert no-sort">
<td></td>
<td></td>
<td><div contenteditable spellcheck="false" class="editable" id="data1" name="name"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data2" name="brand"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data3" name="forGenders"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data4" name="category"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data5" name="price"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data6" name="salePercentage"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data7" name="netPrice"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data8" name="stock"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data9" name="color"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data10" name="madeIn"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data11" name="materials"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data12" name="sizes"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data13" name="date"></div></td>
<td><div contenteditable spellcheck="false" class="editable" id="data14" name="image"></div></td>
<!-- <td><input type="file" name="image" class="editable" id="data14" /></td> -->
<td><button type="submit" name="action" value="add" class="add"><i class="fas fa-plus"></i></button></td>
</tr>
<!-- </tbody> -->
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
    scrollY: 400,
    order: [[ 1, "asc" ]],
    ajax: {
      url: '<?php echo base_url(); ?>admin/showAllItems',
      
      type: 'POST',
      // success: function(data){
        //   console.log(data);
        // }
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
      }
    });
    
    $('#add_item').on('submit', function(e){
      e.preventDefault();
      var name = $('#data1').text();
      var brand = $('#data2').text();
      var forGenders = $('#data3').text();
      var category = $('#data4').text();
      var price = $('#data5').text();
      var salePercentage = $('#data6').text();
      var netPrice = $('#data7').text();
      var stock = $('#data8').text();
      var color = $('#data9').text();
      var madeIn = $('#data10').text();
      var materials = $('#data11').text();
      var sizes = $('#data12').text();
      var date = $('#data13').text();
      var image = $('#data14').text();
      var slug = $('#data1').text();
      
      if(name != '' && brand != '' && forGenders != '' && category != '' && price != '' && salePercentage != '' && netPrice != '' && stock != '' && color != '' && madeIn != '' && materials != '' && sizes != '' && date != '' && image != ''){
        $.ajax({
          url: "<?php echo base_url(); ?>admin/additem",
          method: "POST",
          data: {
            
            name:name, brand:brand, forGenders:forGenders, category:category, price:price, salePercentage:salePercentage, netPrice:netPrice, stock:stock, color:color, madeIn:madeIn, materials:materials, sizes:sizes, date:date, image:image, slug:slug
          },
          success: function(data){
            $('#data1').text("");
            $('#data2').text("");
            $('#data3').text("");
            $('#data4').text("");
            $('#data5').text("");
            $('#data6').text("");
            $('#data7').text("");
            $('#data8').text("");
            $('#data9').text("");
            $('#data10').text("");
            $('#data11').text("");
            $('#data12').text("");
            $('#data13').text("");
            $('#data14').text("");
            $('.checkbox-all').prop('indeterminate', false);
            $('.checkbox-all').prop('checked', false);
            $('.delete-all').hide( "slow");
            dataTable.ajax.reload();  
          }
        });
      }
      else{
        alert('All Fields Required')
      }
    });
    
    function update_item(id, column, value)
    {
      $.ajax({
        url: "<?php echo base_url(); ?>admin/updateItem",
        method: "POST",
        data: {id:id, column:column, value:value},
        success:function(data)
        {
          $('.checkbox-all').prop('indeterminate', false);
          $('.checkbox-all').prop('checked', false);
          $('.delete-all').hide( "slow");
          dataTable.ajax.reload();  
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
    
    dataTable.on('blur', '.update', function() {
      var value = $(this).text();
      
      if(value == ''){
        $(this).text(oldValue);
        alert("Please fill in this field");
      }
      
      if(value != oldValue && value != ''){
        var id = $(this).data("id");
        var column = $(this).data("column");
        update_item(id, column, value);
      }
    });

    dataTable.on('blur', '.updatePrice', function() {
      var value = $(this).text();
      
      if(value != oldValue){
        var netPriceColumn = $(this).closest('tr').find('.netPrice');
        var salePercentageColumn = $(this).closest('tr').find('.salePercentage');

        var salePercentage = parseInt(salePercentageColumn.text());
        var netPrice;

        if(value == ''){
          value = 0;
        }
        price = parseInt(value);
        saleInDecimal = salePercentage / 100;
        var discountValue = price * saleInDecimal
        netPrice = price - discountValue;
				
				netPriceColumn.text(netPrice);

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
        var netPriceColumn = $(this).closest('tr').find('.netPrice');
        var priceColumn = $(this).closest('tr').find('.price');

        var price = parseInt(priceColumn.text());
        var netPrice;

        if(value == '' ){
          value = 0;
        }
        salePercentage= parseInt(value);
        saleInDecimal = salePercentage / 100;
        var discountValue = price * saleInDecimal;
        netPrice = price - discountValue;
				
				netPriceColumn.text(netPrice);

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
				update_item(id, column, value);
			});
    
    dataTable.on('click', '.delete', function () {
      var id = $(this).attr("id");
      if(confirm("Are you sure you want to remove this item?")){
        $.ajax({  
          url:"<?php echo base_url(); ?>admin/deleteItem",
          method:"POST",  
          data:{id:id},  
          success:function(data){
            $('.checkbox-all').prop('indeterminate', false);
            $('.checkbox-all').prop('checked', false);
            $('.delete-all').hide( "slow");
            dataTable.ajax.reload();  
          } 
        });
      }      
    });
    
    $('.delete-all').on('click', function(){
      if(confirm("Are you sure you want to remove selected rows?"))
      {
        var id = [];
        
        $('.checkbox:checked').each(function(i){
          id[i] = $(this).data('id');
        });
        
        $.ajax({
          url:"<?php echo base_url(); ?>admin/deleteAllItem",
          method:"POST",
          data:{id:id},
          success:function(data){
            $('.checkbox-all').prop('indeterminate', false);
            $('.checkbox-all').prop('checked', false);
            $('.delete-all').hide( "slow");
            dataTable.ajax.reload();  
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
      } else if(selected.length == 0){
        $('.checkbox-all').prop('indeterminate', false);
        $('.checkbox-all').prop('checked', false);
        $('.delete-all').hide( "slow");
      } else if (selected.length > 0){
        $('.checkbox-all').prop('indeterminate', true);
        $('.delete-all').show( "slow");
      }
    });
          
    $(".checkbox-all").click(function(){
      $('input:checkbox').not(this).prop('checked', this.checked);
      
      if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('.delete-all').show( "slow");
      } else if($('.checkbox:checked').length == 0){
        $('.delete-all').hide( "slow");
      }
    });
    
  });
</script>