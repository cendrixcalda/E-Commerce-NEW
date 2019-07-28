<div class="dtHorizontalVerticalExampleWrapper">
  <table id="dtHorizontalVerticalExample" class="table  table-bordered table-sm " cellspacing="0"
    width="100%">
    <thead>
      <tr>
        <th class="no-sort">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck1">
            <label class="custom-control-label" for="tableDefaultCheck1">Sellect All</label>
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
        <th class="no-sort"><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i>Delete All</button></th>
      </tr>
    </thead>
    <tbody>
    <?php $rowCount = 2; ?>
    <?php foreach($items as $item) : ?>
      <tr>
        <th scope="row">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="tableDefaultCheck<?php echo $rowCount ?>">
            <label class="custom-control-label" for="tableDefaultCheck<?php echo $rowCount ?>">Select</label>
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
        <td><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i>Delete</button></td>
      </tr>
      <?php $rowCount++; ?>
    <?php endforeach; ?>
      <!-- <tr>
        <td>Tiger</td>
        <td>Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td>61</td>
        <td>2011/04/25</td>
        <td>$320,800</td>
        <td>5421</td>
        <td>t.nixon@datatables.net</td>
      </tr> -->
      <!-- <tr>
        <td>Garrett</td>
        <td>Winters</td>
        <td>Accountant</td>
        <td>Tokyo</td>
        <td>63</td>
        <td>2011/07/25</td>
        <td>$170,750</td>
        <td>8422</td>
        <td>g.winters@datatables.net</td>
      </tr>
      <tr>
        <td>Ashton</td>
        <td>Cox</td>
        <td>Junior Technical Author</td>
        <td>San Francisco</td>
        <td>66</td>
        <td>2009/01/12</td>
        <td>$86,000</td>
        <td>1562</td>
        <td>a.cox@datatables.net</td>
      </tr>
      <tr>
        <td>Cedric</td>
        <td>Kelly</td>
        <td>Senior Javascript Developer</td>
        <td>Edinburgh</td>
        <td>22</td>
        <td>2012/03/29</td>
        <td>$433,060</td>
        <td>6224</td>
        <td>c.kelly@datatables.net</td>
      </tr>
      <tr>
        <td>Airi</td>
        <td>Satou</td>
        <td>Accountant</td>
        <td>Tokyo</td>
        <td>33</td>
        <td>2008/11/28</td>
        <td>$162,700</td>
        <td>5407</td>
        <td>a.satou@datatables.net</td>
      </tr>
      <tr>
        <td>Brielle</td>
        <td>Williamson</td>
        <td>Integration Specialist</td>
        <td>New York</td>
        <td>61</td>
        <td>2012/12/02</td>
        <td>$372,000</td>
        <td>4804</td>
        <td>b.williamson@datatables.net</td>
      </tr>
      <tr>
        <td>Brielle</td>
        <td>Williamson</td>
        <td>Integration Specialist</td>
        <td>New York</td>
        <td>61</td>
        <td>2012/12/02</td>
        <td>$372,000</td>
        <td>4804</td>
        <td>b.williamson@datatables.net</td>
      </tr>
      <tr>
        <td>Brielle</td>
        <td>Williamson</td>
        <td>Integration Specialist</td>
        <td>New York</td>
        <td>61</td>
        <td>2012/12/02</td>
        <td>$372,000</td>
        <td>4804</td>
        <td>b.williamson@datatables.net</td>
      </tr>
      <tr>
        <td>Brielle</td>
        <td>Williamson</td>
        <td>Integration Specialist</td>
        <td>New York</td>
        <td>61</td>
        <td>2012/12/02</td>
        <td>$372,000</td>
        <td>4804</td>
        <td>b.williamson@datatables.net</td>
      </tr>
      <tr>
        <td>Brielle</td>
        <td>Williamson</td>
        <td>Integration Specialist</td>
        <td>New York</td>
        <td>61</td>
        <td>2012/12/02</td>
        <td>$372,000</td>
        <td>4804</td>
        <td>b.williamson@datatables.net</td>
      </tr>
      <tr>
        <td>Brielle</td>
        <td>Williamson</td>
        <td>Integration Specialist</td>
        <td>New York</td>
        <td>61</td>
        <td>2012/12/02</td>
        <td>$372,000</td>
        <td>4804</td>
        <td>b.williamson@datatables.net</td>
      </tr>
      <tr>
        <td>Brielle</td>
        <td>Williamson</td>
        <td>Integration Specialist</td>
        <td>New York</td>
        <td>61</td>
        <td>2012/12/02</td>
        <td>$372,000</td>
        <td>4804</td>
        <td>b.williamson@datatables.net</td>
      </tr>
      <tr>
        <td>Brielle</td>
        <td>Williamson</td>
        <td>Integration Specialist</td>
        <td>New York</td>
        <td>61</td>
        <td>2012/12/02</td>
        <td>$372,000</td>
        <td>4804</td>
        <td>b.williamson@datatables.net</td>
      </tr> -->
    </tbody>
  </table> 
</div>