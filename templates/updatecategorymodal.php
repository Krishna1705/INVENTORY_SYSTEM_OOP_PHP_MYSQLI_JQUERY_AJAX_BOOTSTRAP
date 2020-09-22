<div class="modal fade" id="updatecategorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

           <form id="form_update_category"  name="form_update_category" onsubmit="return false">
           <span id="cat_add_success"></span>

                <div class="form-group">
                    <input type="hidden" name="cid" id="cid" value="">
                  <label>Category Name</label>
                  <input type="text" class="form-control" id="update_cat_name" name="update_cat_name" placeholder="Enter Category Name">
                  <div id="cat_name_error"></div>
                </div>
                <div class="form-group">
                <label>Select Parent Category</label>
                  <select id="update_parent_cat" name="update_parent_cat" class="form-control" required>
                     <!--<option value="0">Root</option>-->
                  </select>
                
                </div>
                
                <button type="submit" class="btn btn-primary">Update Category</button>
           </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
      </div>
    </div>
  </div>
</div>