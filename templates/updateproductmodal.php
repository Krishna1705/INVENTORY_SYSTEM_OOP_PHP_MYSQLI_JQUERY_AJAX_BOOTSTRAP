<div class="modal fade" id="updateproductmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div id="product_add_success"></div>
        <form id="update_form_product" onsubmit="return false">
        <input type="hidden" class="form-control" id="pid" name="pid" value=''>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Date</label>
              <input type="text" class="form-control" id="update_added_date" name="update_added_date" value="<?php echo date("Y-m-d"); ?>" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Product Name</label>
              <input type="text" class="form-control" id="update_product_name" name="update_product_name" placeholder="Product Name" required>
            </div>
          </div>
          <div class="form-group">
            <label>Category</label>
            <select class="form-control" id="update_select_cat" name="update_select_cat" value="Choose Category" required>
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label>Brand</label>
            <select class="form-control" id="update_select_brand" name="update_select_brand" value="Choose Brand" required>
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label>Product Price</label>
            <input type="text" class="form-control" id="update_product_price" name="update_product_price" placeholder="Product Price" required>
          </div>
          <div class="form-group">
            <label>Quantity</label>
            <input type="text" class="form-control" id="update_product_qty" name="update_product_qty" placeholder="Product Quantity" required>
          </div>
          <button type="submit" class="btn btn-primary">Edit Products</button>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>