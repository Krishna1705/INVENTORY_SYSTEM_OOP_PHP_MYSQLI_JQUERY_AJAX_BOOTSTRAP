<div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

           <form id="form_category" onsubmit="return false">
           <span id="cat_add_success"></span>
                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Enter Category Name">
                  <div id="cat_name_error"></div>
                </div>
                <div class="form-group">
                <label>Select Parent Category</label>
                  <select id="parent_cat" name="parent_cat" class="form-control" required>
                     <!--<option value="0">Root</option>-->
                  </select>
                
                </div>
                
                <button type="submit" class="btn btn-primary">Add Category</button>
           </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
      </div>
    </div>
  </div>
</div>