<div class="dtHorizontalVerticalExampleWrapper">
  <table id="dtHorizontalVerticalExample" class="table  table-bordered table-sm " cellspacing="0"
    width="100%">
    <thead>
      <tr>
        <th class="no-sort">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck1">
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
    <tbody>
      <tr class="insert">
          <td></td>
          <td></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><div contenteditable spellcheck="false" class="editable" data-column="ticketNumber" id="data3"></div></td>
          <td><button type="button" class="delete-all"><i class="fas fa-plus"></i></button></td>
      </tr>
      
      <?php $rowCount = 2; ?>
      <?php foreach($items as $item) : ?>
        <tr>
          <th scope="row">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="tableDefaultCheck<?php echo $rowCount ?>">
              <label class="custom-control-label" for="tableDefaultCheck<?php echo $rowCount ?>"></label>
            </div>
          </th>
          <td><?php echo $item['itemID']; ?></td>
          <td><?php echo $item['name']; ?></td>
          <td><?php echo $item['brand']; ?></td>
          <td><?php echo $item['forGenders']; ?></td>
          <td><?php echo $item['category']; ?></td>
          <td><?php echo $item['price']; ?></td>
          <td><?php echo $item['salePercentage']; ?></td>
          <td><?php echo $item['netPrice']; ?></td>
          <td><?php echo $item['stock']; ?></td>
          <td><?php echo $item['color']; ?></td>
          <td><?php echo $item['madeIn']; ?></td>
          <td><?php echo $item['materials']; ?></td>
          <td><?php echo $item['sizes']; ?></td>
          <td><?php echo $item['date']; ?></td>
          <td><?php echo $item['image']; ?></td>
          <td><button type="button" class="delete" id="<?php echo $item['itemID']; ?>"><i class="fas fa-trash"></i></button></td>
        </tr>
        <?php $rowCount++; ?>
      <?php endforeach; ?>
    </tbody>
  </table> 
</div>