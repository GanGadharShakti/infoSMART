<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <!-- Customer Moving Details -->
                    <div class="card-body">
                        <div class="w-100 ele-bg p-4 mb-4">
                            <h4>Customer Moving Details</h4>
                        </div>

                        <form class="forms-sample">
                            <!-- First Row -->
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label class="fw-semibold">Customer Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="fw-semibold">Customer Mobile</label>
                                    <input type="text" class="form-control" placeholder="Enter Mobile">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="fw-semibold">Optional Mobile</label>
                                    <input type="text" class="form-control" placeholder="Optional Mobile">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="fw-semibold">Customer Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email">
                                </div>
                            </div>

                            <!-- Second Row -->
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="home-size" class="fw-semibold">Select Home Size</label>
                                    <select id="home-size" class="form-select">
                                        <option value="all">Select Home Size</option>
                                        <option value="rk">1 RK</option>
                                        <option value="bhk_lite">1 BHK LITE</option>
                                        <option value="bhk_heavy">1 BHK HEAVY</option>
                                        <option value="bhk_lite">2 BHK LITE</option>
                                        <option value="bhk_heavy">2 BHK HEAVY</option>
                                        <option value="bhk_lite">3 BHK LITE</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="fw-semibold">Moving Date</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="moving_time" class="fw-semibold">Moving Time</label>
                                    <select id="moving_time" class="form-select">
                                        <option value="07:00 AM">07:00 AM</option>
                                        <option value="07:30 AM">07:30 AM</option>
                                        <option value="08:00 AM">08:00 AM</option>
                                        <option value="08:30 AM">08:30 AM</option>
                                        <option value="09:00 AM">09:00 AM</option>
                                        <option value="09:30 AM">09:30 AM</option>
                                        <option value="10:00 AM">10:00 AM</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Third Row -->
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="upload_source" class="fw-semibold">Source</label>
                                    <select id="upload_source" class="form-select">
                                        <option value="Eleplace Website">elePLACE Website</option>
                                        <option value="elePLACE Direct">elePLACE Direct</option>
                                        <option value="elePLACE Google Campaign">elePLACE Google Campaign</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="upload_move_type" class="fw-semibold">Move Type</label>
                                    <select id="upload_move_type" class="form-select">
                                        <option value="Within City">Within City</option>
                                        <option value="Inter City">Inter City</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="upload_city" class="fw-semibold">City</label>
                                    <select id="upload_city" class="form-select">
                                        <option value="Mumbai">Mumbai</option>
                                        <option value="Bengaluru">Bengaluru</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="upload_state" class="fw-semibold">State</label>
                                    <select id="upload_state" class="form-select">
                                        <option value="">Select State</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Fourth Row -->
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="fw-semibold">Moving From</label>
                                    <input type="text" class="form-control" placeholder="Enter Location">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="fw-semibold">Moving Floor No</label>
                                    <input type="text" class="form-control" placeholder="Enter Floor No">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="service_lift" class="fw-semibold">Service Lift</label>
                                    <select id="service_lift" class="form-select">
                                        <option value="">Select Service Lift</option>
                                        <option value="Available">Available</option>
                                        <option value="Not Available">Not Available</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Fifth Row -->
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label class="fw-semibold">Distance</label>
                                    <input type="text" class="form-control" placeholder="Enter Distance">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="fw-semibold">Remark</label>
                                    <input type="text" class="form-control" placeholder="Enter Remark">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="fw-semibold" for="sendMail">Send Mail To Customer</label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input custom-switch fs-2"
                                            id="sendMail">
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label class="fw-semibold" for="getSign">Get Sign</label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input custom-switch fs-2" id="getSign">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- Customer Inventory -->
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

                    <!-- Additional Inventory -->
                    <div class="card-body">
                        <div class="w-100 ele-bg p-4 mb-4">
                            <h4>Additional Inventory</h4>
                        </div>

                        <form class="forms-sample">
                            <!-- First Row -->
                            <div class="row">
                                <div class="form-group">
                                    <label class="mb-2 fw-semibold" for="">Upload Additional Moving Details</label>
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

                            <!-- Second Row -->
                            <div class="row justify-content-center">
                                <div class="col-4">
                                    <button type="button" class="custom-button">Submit</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="custom-button">Back</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>