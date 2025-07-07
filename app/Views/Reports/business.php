<div class="main-panel">
    <div class="content-wrapper">
        <!-- Table starts from here  -->
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="w-100 p-2 mb-4 d-flex">
                            <i class="fa fa-chart-bar me-2"></i>
                            <h4>Reports</h4>
                        </div>

                        <div class="row">
                            <div class="col-3 form-group">
                                <label for="city" class="fw-semibold text-start d-block">City:</label>
                                <select id="city" class="form-select">
                                    <option value="">Select City Name</option>
                                    <option value="Mumbai">Mumbai</option>
                                    <option value="Bengaluru">Bengaluru</option>
                                    <option value="Pune">Pune</option>
                                    <option value="Gurgaon">Gurgaon</option>
                                    <option value="Chennai">Chennai</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Faridabad">Faridabad</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Noida">Noida</option>
                                    <option value="Ghaziabad">Ghaziabad</option>
                                </select>
                            </div>

                            <div class="col-3  form-group">
                                <label for="source" class="fw-semibold text-start d-block">Source:</label>
                                <select id="source" class="form-select">
                                    <option value="">elePLACE Direct</option>
                                    <option value="Mumbai">elePLACE Website</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <div class="btn-group">
                                    <button type="button" class="all-lead-button">Today</button>
                                    <button type="button" class="all-lead-button">Last Week</button>
                                    <button type="button" class="all-lead-button">This Month</button>
                                    <button type="button" class="all-lead-button">This Year</button>
                                    <button type="button" class="all-lead-button">Custom</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 stretch-card grid-margin">
                                <div class="card bg-gradient-danger card-img-holder text-white p-3">
                                    <div class="card-body">
                                        <img src="<?= base_url() ?>assets/images/dashboard/circle.svg"
                                            class="card-img-absolute" alt="circle-image" />
                                        <h4 class="font-weight-normal mb-2 text-center fs-4">All Leads</h4>
                                        <div class="d-flex justify-content-center">
                                            <div class="text-center">
                                                <h2 class="mr-3 fs-6">Lead Count</h2>
                                                <p class="lead-count">1234</p> <!-- Dummy Lead Count -->
                                            </div>
                                            <div class="vertical-line"></div>
                                            <div class="text-center">
                                                <h2 class="ml-3 fs-6">Percentage</h2>
                                                <p class="percentage">85%</p> <!-- Dummy Percentage -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 stretch-card grid-margin">
                                <div class="card bg-gradient-danger card-img-holder text-white p-3">
                                    <div class="card-body">
                                        <img src="<?= base_url() ?>assets/images/dashboard/circle.svg"
                                            class="card-img-absolute" alt="circle-image" />
                                        <h4 class="font-weight-normal mb-2 text-center fs-4">Intra City</h4>
                                        <div class="d-flex justify-content-center">
                                            <div class="text-center">
                                                <h2 class="mr-3 fs-6">Lead Count</h2>
                                                <p class="lead-count">1234</p> <!-- Dummy Lead Count -->
                                            </div>
                                            <div class="vertical-line"></div>
                                            <div class="text-center">
                                                <h2 class="ml-3 fs-6">Percentage</h2>
                                                <p class="percentage">85%</p> <!-- Dummy Percentage -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 stretch-card grid-margin">
                                <div class="card bg-gradient-danger card-img-holder text-white p-3">
                                    <div class="card-body">
                                        <img src="<?= base_url() ?>assets/images/dashboard/circle.svg"
                                            class="card-img-absolute" alt="circle-image" />
                                        <h4 class="font-weight-normal mb-2 text-center fs-4">Inter City</h4>
                                        <div class="d-flex justify-content-center">
                                            <div class="text-center">
                                                <h2 class="mr-3 fs-6">Lead Count</h2>
                                                <p class="lead-count">1234</p> <!-- Dummy Lead Count -->
                                            </div>
                                            <div class="vertical-line"></div>
                                            <div class="text-center">
                                                <h2 class="ml-3 fs-6">Percentage</h2>
                                                <p class="percentage">85%</p> <!-- Dummy Percentage -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Above the table -->
                        <div class="row mt-3 mb-4">
                            <!-- Left Corner: Show Entries -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="showEntries" class="me-2">Show</label>
                                <select id="showEntries" class="form-select form-select-sm w-auto">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span class="ms-2">entries</span>
                            </div>

                            <!-- Right Corner: Search Input -->
                            <div class="col-md-6 text-end">
                                <label for="tableSearch" class="me-2">Search:</label>
                                <input type="text" id="tableSearch"
                                    class="form-control form-control-sm w-auto d-inline">
                            </div>
                        </div>

                        <!-- Responsive Table -->
                        <div class="table-responsive">
                            <table id="dataTable" class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th>SR No</th>
                                        <th>Lead Id</th>
                                        <th>Lead Date</th>
                                        <th>Customer Name</th>
                                        <th>Contact Number</th>
                                        <th>Home Size</th>
                                        <th>SPANCO</th>
                                        <th>City</th>
                                        <th>Move Date</th>
                                        <th>Type</th>
                                        <th>Source</th>
                                        <th>ELE Quote</th>
                                        <th>Lead Manager</th>
                                        <th>Dealsheet Amount</th>
                                        <th>Email Id</th>
                                        <th>Ticket No</th>
                                        <th>Moving From</th>
                                        <th>Moving To</th>
                                        <th>Lead received Time</th>
                                        <th>Week wise</th>
                                        <th>Month</th>
                                        <th>Move confirm date</th>
                                        <th>Customer Payment Status</th>
                                        <th>Partner Assigned</th>
                                        <th>Partner Lead Confirm Lead</th>
                                        <th>Highest Quotation Amt</th>
                                        <th>Lowest Quotation Amt</th>
                                        <th>Margin</th>
                                        <th>Insurance</th>
                                        <th>Deep Cleaning</th>
                                        <th>Advanced Amt recv</th>
                                        <th>Pending Amt</th>
                                        <th>Final Status</th>
                                        <th>Partner payment status</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>

                                <tbody id="dataBody">
                                    <tr>
                                        <td>1</td>
                                        <td>LD1001</td>
                                        <td>2025-03-01</td>
                                        <td>John Doe</td>
                                        <td>+91 9876543210</td>
                                        <td>3BHK, 1500 sqft</td>
                                        <td>SPANCO1</td>
                                        <td>Delhi</td>
                                        <td>2025-03-15</td>
                                        <td>Residential</td>
                                        <td>Referral</td>
                                        <td>15000</td>
                                        <td>Jane Smith</td>
                                        <td>200000</td>
                                        <td>john.doe@example.com</td>
                                        <td>TK1001</td>
                                        <td>New Delhi</td>
                                        <td>Mumbai</td>
                                        <td>2025-03-02 10:00 AM</td>
                                        <td>Week 1</td>
                                        <td>March</td>
                                        <td>2025-03-10</td>
                                        <td>Paid</td>
                                        <td>Assigned</td>
                                        <td>Confirmed</td>
                                        <td>25000</td>
                                        <td>10000</td>
                                        <td>5000</td>
                                        <td>Yes</td>
                                        <td>No</td>
                                        <td>10000</td>
                                        <td>Pending</td>
                                        <td>Confirmed</td>
                                        <td>Paid</td>
                                        <td>No remarks</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- End of Table -->
                    </div>
                </div>
            </div>
        </div>