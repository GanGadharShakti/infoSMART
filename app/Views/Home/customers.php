<div class="main-panel">
    <div class="content-wrapper">
        <!-- Table starts from here  -->
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 row g-2 align-items-end my-4">

                            <!-- Global Search -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <label for="globalSearch" class="form-label">Global Search</label>
                                <input type="text" id="globalSearch" class="form-control" placeholder="Enter keyword">
                            </div>

                            <!-- Sort By (Dropdown) -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <label for="sortBy" class="form-label">Sort by</label>
                                <select id="sortBy" class="form-select">
                                    <option selected disabled>Select</option>
                                    <option>Today</option>
                                    <option>Yesterday</option>
                                    <option>Tomorrow</option>
                                    <option>Next 7 Days</option>
                                    <option>Lead Date</option>
                                    <option>Move Date</option>
                                    <option>Move Confirmation Date</option>
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
                                <button class="custom-button">Search</button>
                            </div>

                            <!-- Download Button -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <button class="custom-button">Download</button>
                            </div>

                        </div>



                        <!-- Below the table -->
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
                            <table id="dataTable1" class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>No.</th>
                                        <th>Lead Id</th>
                                        <th>Customer Name</th>
                                        <th>Move Size</th>
                                        <th>Home Size</th>
                                        <th>Source</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dataBody1">
                                    <tr>
                                        <td><i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                                                data-bs-toggle="modal" data-bs-target="#actionModal"
                                                data-id="LD1001"></i></td>
                                        <td>1</td>
                                        <td>LD1001</td>
                                        <td>John Doe</td>
                                        <td>05 March 2025</td>
                                        <td>3BHK</td>
                                        <td>+1 234 567 890</td>
                                        <td>New</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                                                data-bs-toggle="modal" data-bs-target="#actionModal"
                                                data-id="LD1002"></i></td>
                                        <td>2</td>
                                        <td>LD1002</td>
                                        <td>Jane Smith</td>
                                        <td>06 March 2025</td>
                                        <td>2BHK</td>
                                        <td>+1 987 654 321</td>
                                        <td>Follow-up</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                                                data-bs-toggle="modal" data-bs-target="#actionModal"
                                                data-id="LD1003"></i></td>
                                        <td>3</td>
                                        <td>LD1003</td>
                                        <td>Robert Brown</td>
                                        <td>07 March 2025</td>
                                        <td>4BHK</td>
                                        <td>+1 456 789 012</td>
                                        <td>Confirmed</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                                                data-bs-toggle="modal" data-bs-target="#actionModal"
                                                data-id="LD1004"></i></td>
                                        <td>4</td>
                                        <td>LD1004</td>
                                        <td>Emily Johnson</td>
                                        <td>08 March 2025</td>
                                        <td>1BHK</td>
                                        <td>+1 321 654 987</td>
                                        <td>Pending</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                                                data-bs-toggle="modal" data-bs-target="#actionModal"
                                                data-id="LD1005"></i></td>
                                        <td>5</td>
                                        <td>LD1005</td>
                                        <td>Chris Wilson</td>
                                        <td>09 March 2025</td>
                                        <td>2BHK</td>
                                        <td>+1 147 258 369</td>
                                        <td>Cancelled</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                                                data-bs-toggle="modal" data-bs-target="#actionModal"
                                                data-id="LD1006"></i></td>
                                        <td>6</td>
                                        <td>LD1006</td>
                                        <td>Olivia Taylor</td>
                                        <td>10 March 2025</td>
                                        <td>3BHK</td>
                                        <td>+1 963 852 741</td>
                                        <td>Completed</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                                                data-bs-toggle="modal" data-bs-target="#actionModal"
                                                data-id="LD1007"></i></td>
                                        <td>7</td>
                                        <td>LD1007</td>
                                        <td>Daniel Garcia</td>
                                        <td>11 March 2025</td>
                                        <td>4BHK</td>
                                        <td>+1 753 159 852</td>
                                        <td>New</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                                                data-bs-toggle="modal" data-bs-target="#actionModal"
                                                data-id="LD1008"></i></td>
                                        <td>8</td>
                                        <td>LD1008</td>
                                        <td>Ella Martinez</td>
                                        <td>12 March 2025</td>
                                        <td>2BHK</td>
                                        <td>+1 789 456 123</td>
                                        <td>Follow-up</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                                                data-bs-toggle="modal" data-bs-target="#actionModal"
                                                data-id="LD1009"></i></td>
                                        <td>9</td>
                                        <td>LD1009</td>
                                        <td>Jack Thomas</td>
                                        <td>13 March 2025</td>
                                        <td>1BHK</td>
                                        <td>+1 852 456 741</td>
                                        <td>Confirmed</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                                                data-bs-toggle="modal" data-bs-target="#actionModal"
                                                data-id="LD1010"></i></td>
                                        <td>10</td>
                                        <td>LD1010</td>
                                        <td>Sophia Clark</td>
                                        <td>14 March 2025</td>
                                        <td>3BHK</td>
                                        <td>+1 654 321 987</td>
                                        <td>Pending</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- End of Table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table ends from here  -->

    <!-- Modal -->
    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Action Icons -->
                    <div class="container text-center">
                        <div class="row g-3">
                            <div class="col-4 c-p">
                                <i class="fa fa-eye fa-2x text-success" data-bs-toggle="modal"
                                    data-bs-target="#actionModal1"></i>
                                <p class="small">view</p>
                            </div>
                            <div class="col-4 c-p">
                                <i class="fa fa-user fa-2x text-danger" data-bs-toggle="modal"
                                    data-bs-target="#actionModal2"></i>
                                <p class="small">Assign Lead</p>
                            </div>
                            <div class="col-4 c-p">
                                <i class="fa fa-pencil-square-o fa-2x text-primary" data-bs-toggle="modal"
                                    data-bs-target="#actionModal3"></i>
                                <p class="small">Edit Inventory</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- View Inventory Modal -->
    <div class="modal fade" id="actionModal1" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actionModalLabel">Customer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container">
                        <!-- Centered Button -->
                        <div class="text-center mb-3">
                            <button class="custom-button">Send Welcome Mail</button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-4">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <h5>Customer Moving Details</h5>
                                        <table class="table table-bordered moving-details-table">
                                            <tbody>
                                                <tr>
                                                    <th>Name</th>
                                                    <td>Harpreet Singh (1)</td>
                                                </tr>
                                                <tr>
                                                    <th>Email ID</th>
                                                    <td>apreet25@gmail.com</td>
                                                </tr>
                                                <tr>
                                                    <th>Mobile No</th>
                                                    <td>9999222106</td>
                                                </tr>
                                                <tr>
                                                    <th>Last Quote Amt</th>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <th>Remark</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Moving Date</th>
                                                    <td>08-04-2025</td>
                                                </tr>
                                                <tr>
                                                    <th>Moving From</th>
                                                    <td>Sector 1 Road, Imt Manesar, Gurugram, Haryana, India</td>
                                                </tr>
                                                <tr>
                                                    <th>Loading Floor No</th>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <th>Loading Service Lift</th>
                                                    <td>Not Available</td>
                                                </tr>
                                                <tr>
                                                    <th>Moving To</th>
                                                    <td>Thapar Institute of Engineering & Technology, Bhadson Rd, Adarsh
                                                        Nagar, Prem Nagar, Patiala, Punjab 147004, India</td>
                                                </tr>
                                                <tr>
                                                    <th>Unloading Floor No</th>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <th>Unloading Service Lift</th>
                                                    <td>Not Available</td>
                                                </tr>
                                                <tr>
                                                    <th>Approx Distance</th>
                                                    <td>256.5</td>
                                                </tr>
                                                <tr>
                                                    <th>Home Size</th>
                                                    <td>1 RK</td>
                                                </tr>
                                                <tr>
                                                    <th>Moving Time</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Move Type</th>
                                                    <td>Intercity</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <!-- Right Column -->
                                    <div class="col-md-6">
                                        <h5>Customer Inventory</h5>

                                        <!-- Inventory Table -->
                                        <table class="table table-bordered inventory-table mb-4">
                                            <tbody>
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th>Quantity</th>
                                                    <th>Move Type</th>
                                                </tr>
                                                <tr>
                                                    <td>Suzuki Scooty 110 CC</td>
                                                    <td>1</td>
                                                    <td>Custom Item</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">Total</td>
                                                    <td>1</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <!-- Article Table -->
                                        <table class="table table-bordered article-table">
                                            <tbody>
                                                <tr>
                                                    <th>Artical Name</th>
                                                    <th>Assemble & Dissamble</th>
                                                    <th>Wood Crating</th>
                                                    <th>Wall Dismounting</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="actionModal2" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container text-center">
                        <div class="row g-3">
                            <div class="card">
                                <div class="card-body">

                                    <form class="forms-sample">
                                        <!-- First Row -->
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="fw-semibold text-start d-block">Select City</label>
                                                <select class="form-select">
                                                    <option value="1">Mumbai</option>
                                                    <option value="2">Bengaluru</option>
                                                    <option value="3">Pune</option>
                                                    <option value="4">Gurgaon</option>
                                                    <option value="5">Chennai</option>
                                                    <option value="6">Hyderabad</option>
                                                    <option value="7">Faridabad</option>
                                                    <option value="8">Delhi</option>
                                                    <option value="9">Noida</option>
                                                    <option value="10">Ghaziabad</option>
                                                    <option value="11">Indore</option>
                                                    <option value="12">Nagpur</option>
                                                    <option value="13">Aurangabad</option>
                                                    <option value="14">Kolkata</option>
                                                    <option value="15">Guntur</option>
                                                    <option value="16">Aligarh</option>
                                                    <option value="18">Kerala</option>
                                                    <option value="19">Eluru</option>
                                                    <option value="20">Ahemdabad</option>
                                                    <option value="21">Lucknow</option>
                                                    <option value="22">Vizag</option>
                                                    <option value="23">Bhubaneswar</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Second Row -->
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="fw-semibold text-start d-block">Select Patner</label>
                                                <select class="form-select">
                                                    <option value="1">Nakul</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Third Row -->
                                        <div class="row d-flex flex-sm-column gap-4 justify-content-center">
                                            <div class="form-group">
                                                <button type="button" class="custom-button">Cancel</button>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="custom-button">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Assign Lead To Patner -->
    <div class="modal fade" id="actionModal3" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container text-center">
                        <div class="row g-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="w-100 ele-bg p-4 mb-4">
                                        <h4>Customer Moving Details</h4>
                                    </div>

                                    <form class="forms-sample">
                                        <!-- First Row -->
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Customer Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Name">
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Customer Mobile</label>
                                                <input type="text" class="form-control" placeholder="Enter Mobile">
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Optional Mobile</label>
                                                <input type="text" class="form-control" placeholder="Optional Mobile">
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Customer Email</label>
                                                <input type="email" class="form-control" placeholder="Enter Email">
                                            </div>
                                        </div>

                                        <!-- Second Row -->
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Select Home Size</label>
                                                <select class="form-select">
                                                    <option value="all">Select Home Size</option>
                                                    <option value="rk">1 RK</option>
                                                    <option value="bhk_lite">1 BHK LITE</option>
                                                    <option value="bhk_heavy">1 BHK HEAVY</option>
                                                    <option value="bhk_lite">2 BHK LITE</option>
                                                    <option value="bhk_heavy">2 BHK HEAVY</option>
                                                    <option value="bhk_lite">3 BHK LITE</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Moving Date</label>
                                                <input type="date" class="form-control">
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Moving Time</label>
                                                <select class="form-select">
                                                    <option value="07:00 AM">07:00 AM</option>
                                                    <option value="07:30 AM">07:30 AM</option>
                                                    <option value="08:00 AM">08:00 AM</option>
                                                    <option value="08:30 AM">08:30 AM</option>
                                                    <option value="09:00 AM">09:00 AM</option>
                                                    <option value="09:30 AM">09:30 AM</option>
                                                    <option value="10:00 AM">10:00 AM</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Distance</label>
                                                <input type="text" class="form-control" placeholder="Enter Distance">
                                            </div>
                                        </div>

                                        <!-- Third Row -->
                                        <div class="row">
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Source</label>
                                                <select class="form-select">
                                                    <option value="Eleplace Website">elePLACE Website</option>
                                                    <option value="elePLACE Direct">elePLACE Direct</option>
                                                    <option value="elePLACE Google Campaign">elePLACE Google Campaign
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Move Type</label>
                                                <select class="form-select">
                                                    <option value="Within City">Within City</option>
                                                    <option value="Inter City">Inter City</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">City</label>
                                                <select class="form-select">
                                                    <option value="Mumbai">Mumbai</option>
                                                    <option value="Bengaluru">Bengaluru</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">State</label>
                                                <select class="form-select">
                                                    <option value="">Select State</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Fourth Row -->
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="fw-semibold text-start d-block">Moving From</label>
                                                <input type="text" class="form-control" placeholder="Enter Location">
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Moving Floor No</label>
                                                <input type="text" class="form-control" placeholder="Enter Floor No">
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Service Lift</label>
                                                <select class="form-select">
                                                    <option value="">Select Service Lift</option>
                                                    <option value="Available">Available</option>
                                                    <option value="Not Available">Not Available</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Fifth Row -->
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="fw-semibold text-start d-block">Moving To</label>
                                                <input type="text" class="form-control" placeholder="Enter Location">
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Moving Floor No</label>
                                                <input type="text" class="form-control" placeholder="Enter Floor No">
                                            </div>
                                            <div class="col-md-3 form-group">
                                                <label class="fw-semibold text-start d-block">Service Lift</label>
                                                <select class="form-select">
                                                    <option value="">Select Service Lift</option>
                                                    <option value="Available">Available</option>
                                                    <option value="Not Available">Not Available</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Sixth Row -->
                                        <div class="row">
                                            <div class="col-12 form-group">
                                                <label class="fw-semibold text-start d-block">Remark</label>
                                                <textarea class="form-control" placeholder="Enter Remark"></textarea>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <div class="card-body">
                                    <div class="w-100 ele-bg p-4 mb-4">
                                        <h4>Additional Customer Inventory</h4>
                                    </div>

                                    <form class="forms-sample">
                                        <!-- First Row -->
                                        <div class="row">
                                            <div class="col-4 mb-4">
                                                <button type="button" class="custom-button">Add</button>
                                            </div>
                                        </div>

                                        <!-- Second Row -->
                                        <div class="row justify-space-between">
                                            <div class="col-8 d-flex">
                                                <div
                                                    class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                                                    <label class="fw-semibold" for="sendMail">Send Mail To
                                                        Customer</label>
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox"
                                                            class="form-check-input custom-switch fs-2" id="sendMail">
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                                                    <label class="fw-semibold" for="getSign">Get Sign</label>
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox"
                                                            class="form-check-input custom-switch fs-2" id="getSign">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 mb-4">
                                                <button type="button" class="custom-button">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sessionData = <?= json_encode(session()->get()); ?>;
        console.log("Session Data:", sessionData);
    </script>