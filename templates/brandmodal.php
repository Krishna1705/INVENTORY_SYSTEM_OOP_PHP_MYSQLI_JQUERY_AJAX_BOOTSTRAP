<div class="modal fade" id="brandmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
           <form id="form_brand" onsubmit="return false">
           <span id="brand_add_success"></span>
                <div class="form-group">
                  <label>Brand Name</label>
                  <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter Brand Name">
                  <div id="brand_name_error"></div>
                </div>
                
                <button type="submit" class="btn btn-primary">Add Brand</button>
           </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>