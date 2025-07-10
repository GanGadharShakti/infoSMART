                   <div class="main-panel">
                       <div class="content-wrapper">
                           <div class="row">
                               <div class="card-body">
                                   <div class="w-100 ele-bg p-4 mb-4">
                                       <h4>Customer Inventory</h4>
                                   </div>

                                   <form class="forms-sample">

                                       <!-- First Row -->
                                       <div class="row">
                                           <div class="col-md-3 form-group">
                                               <label class="fw-semibold">Item Name</label>
                                               <input type="text" class="form-control" placeholder="Enter Name" class="itemName">
                                           </div>
                                           <div class="col-md-3 form-group">
                                               <label class="fw-semibold">Quantity</label>
                                               <input type="text" class="form-control" placeholder="Enter Quantity"
                                                   class="quantity">
                                           </div>
                                           <div class="col-md-2 form-group">
                                               <label class="fw-semibold">Assemble & Disassemble</label>
                                               <div class="form-check form-switch">
                                                   <input type="checkbox" class="form-check-input custom-switch fs-2 assemble">
                                               </div>
                                           </div>
                                           <div class="col-md-2 form-group">
                                               <label class="fw-semibold">Wood Crating</label>
                                               <div class="form-check form-switch">
                                                   <input type="checkbox" class="form-check-input custom-switch fs-2 crating">
                                               </div>
                                           </div>
                                           <div class="col-md-2 form-group">
                                               <label class="fw-semibold">Wall Dismounting</label>
                                               <div class="form-check form-switch">
                                                   <input type="checkbox" class="form-check-input custom-switch fs-2 dismount">
                                               </div>
                                           </div>
                                       </div>

                                       <!-- Second Row -->
                                       <div class="row mt-3">
                                           <div class="col-4">
                                               <button type="button" class="custom-button mb-4" id="addRowBtn">Add</button>
                                           </div>
                                       </div>

                                       <!-- Dynamic Row After Adding extra Inventory -->
                                       <div id="dynamicRowsContainer"></div>

                                       <!-- Third Row -->
                                       <div class="row">
                                           <div class="form-group">
                                               <input type="file" name="img[]" class="file-upload-default">
                                               <div class="input-group col-xs-12">
                                                   <input type="text" class="form-control file-upload-info" disabled
                                                       placeholder="Upload Image">
                                                   <span class="input-group-append">
                                                       <button class="file-upload-browse btn ele-bg py-3"
                                                           type="button">Upload</button>
                                                   </span>
                                               </div>
                                           </div>
                                       </div>

                                       <!-- Fourth Row -->
                                       <div class="row justify-content-center">
                                           <div class="col-4">
                                               <button type="button" class="custom-button mb-4">Submit</button>
                                           </div>
                                           <div class="col-4">
                                               <button type="button" class="custom-button mb-4">Back</button>
                                           </div>
                                       </div>

                                   </form>
                               </div>