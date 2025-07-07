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


                        <div class="mb-3 row g-2 align-items-end my-4">
                            <!-- Sort By (Dropdown) -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <label for="sortBy" class="form-label">Select Report</label>
                                <select id="sortBy" class="form-select">
                                    <option selected disabled>Select All</option>
                                    <option>Custom Select</option>
                                    <option>Today's</option>
                                </select>
                            </div>

                            <!-- From Date -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <label for="fromDate" class="form-label">From Date</label>
                                <input type="date" id="fromDate" class="form-control">
                            </div>

                            <!-- To Date -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <label for="toDate" class="form-label">To Date</label>
                                <input type="date" id="toDate" class="form-control">
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <button type="button" class="custom-button">Search</button>
                            </div>

                            <!-- Download Button -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <button type="button" class="custom-button">Download</button>
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