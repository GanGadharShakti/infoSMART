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
                                <button type="button" class="btn ele-bg w-100 btn-height">Search</button>
                            </div>

                            <!-- Download Button -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <button type="button" class="btn ele-bg w-100 btn-height">Download</button>
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
                            <table id="dataTable" class="display table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Display Name</th>
                                        <th scope="col">Source Of Supply</th>
                                        <th scope="col">Currency Code</th>
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Salutation</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email ID</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Facebook</th>
                                        <th scope="col">Twitter</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Website</th>
                                        <th scope="col">GST Treatment</th>
                                        <th scope="col">GST Identification Number (GSTIN)</th>
                                        <th scope="col">PAN Number</th>
                                        <th scope="col">Billing Attention</th>
                                        <th scope="col">Billing Address</th>
                                        <th scope="col">Billing Street2</th>
                                        <th scope="col">Billing City</th>
                                        <th scope="col">Billing State</th>
                                        <th scope="col">Billing Country</th>
                                        <th scope="col">Billing Code</th>
                                        <th scope="col">Billing Fax</th>
                                        <th scope="col">Shipping Attention</th>
                                        <th scope="col">Shipping Address</th>
                                        <th scope="col">Shipping Street2</th>
                                        <th scope="col">Shipping City</th>
                                        <th scope="col">Shipping State</th>
                                        <th scope="col">Shipping Country</th>
                                        <th scope="col">Shipping Code</th>
                                        <th scope="col">Shipping Fax</th>
                                    </tr>
                                </thead>
                                <tbody id="dataBody">
                                    <tr>
                                        <td>John Doe</td>
                                        <td>LD1001</td>
                                        <td>INR</td>
                                        <td>XYZ Corp</td>
                                        <td>Mr.</td>
                                        <td>John</td>
                                        <td>Doe</td>
                                        <td>john.doe@example.com</td>
                                        <td>+91 9876543210</td>
                                        <td>+91 9876543210</td>
                                        <td>facebook.com/johndoe</td>
                                        <td>twitter.com/johndoe</td>
                                        <td>No notes</td>
                                        <td>www.xyzcorp.com</td>
                                        <td>Registered</td>
                                        <td>12345ABCDE</td>
                                        <td>ABCDE1234F</td>
                                        <td>John Doe</td>
                                        <td>123 Main St</td>
                                        <td>Apt 101</td>
                                        <td>New Delhi</td>
                                        <td>Delhi</td>
                                        <td>India</td>
                                        <td>110001</td>
                                        <td>+91 11 23456789</td>
                                        <td>Jane Doe</td>
                                        <td>456 Market St</td>
                                        <td>Apt 202</td>
                                        <td>Mumbai</td>
                                        <td>Maharashtra</td>
                                        <td>India</td>
                                        <td>400001</td>
                                        <td>+91 22 23456789</td>
                                    </tr>
                                    <tr>
                                        <td>Alice Smith</td>
                                        <td>LD1002</td>
                                        <td>USD</td>
                                        <td>ABC Ltd.</td>
                                        <td>Ms.</td>
                                        <td>Alice</td>
                                        <td>Smith</td>
                                        <td>alice.smith@example.com</td>
                                        <td>+1 555-1234</td>
                                        <td>+1 555-5678</td>
                                        <td>facebook.com/alicesmith</td>
                                        <td>twitter.com/alicesmith</td>
                                        <td>Important client</td>
                                        <td>www.abcltd.com</td>
                                        <td>Exempt</td>
                                        <td>67890XYZ</td>
                                        <td>XYZ98765A</td>
                                        <td>Alice Smith</td>
                                        <td>789 Elm St</td>
                                        <td>Suite 202</td>
                                        <td>San Francisco</td>
                                        <td>California</td>
                                        <td>USA</td>
                                        <td>94103</td>
                                        <td>+1 415-2345678</td>
                                        <td>Bob Smith</td>
                                        <td>123 Oak St</td>
                                        <td>Suite 303</td>
                                        <td>Los Angeles</td>
                                        <td>California</td>
                                        <td>USA</td>
                                        <td>90001</td>
                                        <td>+1 323-2345678</td>
                                    </tr>
                                    <tr>
                                        <td>Bob Johnson</td>
                                        <td>LD1003</td>
                                        <td>GBP</td>
                                        <td>DEF Inc.</td>
                                        <td>Dr.</td>
                                        <td>Bob</td>
                                        <td>Johnson</td>
                                        <td>bob.johnson@example.com</td>
                                        <td>+44 20 79460123</td>
                                        <td>+44 20 79461234</td>
                                        <td>facebook.com/bobjohnson</td>
                                        <td>twitter.com/bobjohnson</td>
                                        <td>VIP Client</td>
                                        <td>www.definc.com</td>
                                        <td>Registered</td>
                                        <td>98765LMNOP</td>
                                        <td>LMN12345T</td>
                                        <td>Bob Johnson</td>
                                        <td>12 King’s Road</td>
                                        <td>Apt 101</td>
                                        <td>London</td>
                                        <td>England</td>
                                        <td>UK</td>
                                        <td>EC1A 1BB</td>
                                        <td>+44 20 12345678</td>
                                        <td>Lucy Johnson</td>
                                        <td>34 Queen’s Street</td>
                                        <td>Apt 202</td>
                                        <td>Manchester</td>
                                        <td>England</td>
                                        <td>UK</td>
                                        <td>M2 5DA</td>
                                        <td>+44 161 2345678</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- End of Table -->
                    </div>
                </div>
            </div>
        </div>