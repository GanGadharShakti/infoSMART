<!-- Array for dashboard -->
<?php
$cards = [
    [
        'title' => "Today’s Moves",
        'value' => '$15,0000',
        'icon' => 'mdi-arrow-up-bold-circle-outline',
        'color' => 'danger'
    ],
    [
        'title' => "Tomorrow’s Moves",
        'value' => '45,6334',
        'icon' => 'mdi-arrow-right-bold-circle-outline',
        'color' => 'info'
    ],
    [
        'title' => "Week’s Moves",
        'value' => '95,5741',
        'icon' => 'mdi-calendar-week',
        'color' => 'success'
    ],
    [
        'title' => "Month’s Moves",
        'value' => '95,5741',
        'icon' => 'mdi-calendar-month',
        'color' => 'success'
    ],
    [
        'title' => "Month’s Closures",
        'value' => '$15,0000',
        'icon' => 'mdi-close-circle-outline',
        'color' => 'danger'
    ],
    [
        'title' => "Today’s Closures",
        'value' => '45,6334',
        'icon' => 'mdi-close-circle',
        'color' => 'info'
    ],

];

?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <!-- Alert for every action -->

        <!-- Dashboard Card -->
        <div class="row">
            <?php foreach ($cards as $card): ?>
                <div class="col-6 col-md-2 stretch-card grid-margin c-p <?= $card['modal'] ?? false ? 'c-p' : '' ?>"
                    <?= $card['modal'] ?? false ? 'data-bs-toggle="modal" data-bs-target="#actionModal6"' : '' ?>>
                    <div class="card bg-gradient-<?= $card['color'] ?> card-img-holder text-white dashboard-card">
                        <div class="card-body">
                            <img src="<?= base_url() ?>assets/images/dashboard/circle.svg" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-2">
                                <?= $card['title'] ?>
                                <!-- <i class="mdi <?= $card['icon'] ?> mdi-24px float-end"></i> -->
                            </h4>
                            <h2><?= $card['value'] ?></h2>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Dasboard Ends here -->

        <!-- Table starts from here  -->
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 row g-2 align-items-end">

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
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <label for="dateRange" class="form-label">Date Range</label>
                                <div class="input-group">
                                    <input type="date" id="fromDate" class="form-control" placeholder="From Date">
                                    <span class="input-group-text">to</span>
                                    <input type="date" id="toDate" class="form-control" placeholder="To Date">
                                </div>
                            </div>


                            <!-- Submit Button -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <button class="custom-button" id="search-button">Search</button>
                            </div>

                            <!-- Download Button -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                                <button type="button" class="custom-button">Download</button>
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
                            <table id="dataTable" class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Action</th>
                                        <th>Lead Id</th>
                                        <th>Lead Date</th>
                                        <th>Customer Name</th>
                                        <th>Contact No.</th>
                                        <th>Home Size</th>
                                        <th>Warehouse</th>
                                        <!-- <th>Type</th> -->
                                        <th>Service Type</th>
                                    </tr>
                                </thead>
                                <tbody id="dataBody">
                                    <!-- Data will be appended here via AJAX -->
                                </tbody>
                            </table>


                            <div class="pagination-container">
                                <ul id="pagination" class="pagination">
                                    <!-- Pagination buttons will be dynamically generated here -->
                                </ul>
                            </div>
                        </div>

                        <!-- End of Table -->
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
                        <h5 class="modal-title" id="actionModalLabel">Actions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!-- Action Icons -->
                        <div class="container text-center">
                            <div class="row g-3">
                                <div class="col-3 c-p">
                                    <i class="fa fa-pencil-square-o fa-2x ele-color" data-bs-toggle="modal"
                                        data-bs-target="#actionModal1"></i>
                                    <p class="small">Update Record</p>
                                </div>
                                <div class="col-3 c-p">
                                    <i class="fa fa-trash fa-2x text-danger"></i>
                                    <p class="small">Delete</p>
                                </div>
                                <div class="col-3 c-p">
                                    <i class="fa fa-envelope-o fa-2x text-danger"></i>
                                    <p class="small">send mail</p>
                                </div>
                                <div class="col-3 c-p">
                                    <i class="fa fa-eye fa-2x text-primary"></i>
                                    <p class="small">view</p>
                                </div>
                            </div>
                            <!-- <div class="row g-3 mt-2">
                                <div class="col-3 c-p">
                                    <i class="fa fa-window-close fa-2x text-danger"></i>
                                    <p class="small">Delete</p>
                                </div>
                                <div class="col-3 c-p">
                                    <i class="fa fa-share fa-2x text-danger"></i>
                                    <p class="small">Response Mail</p>
                                </div>
                                <div class="col-3 c-p">
                                    <i class="fa fa-share-square-o fa-2x text-danger"></i>
                                    <p class="small">Follow Up Mail</p>
                                </div>
                                <div class="col-3 c-p">
                                    <i class="fa fa-vcard-o fa-2x text-danger" data-bs-toggle="modal"
                                        data-bs-target="#actionModal3"></i>
                                    <p class="small">Generate LR</p>
                                </div>
                                <div class="col-3 c-p">
                                    <i class="fa fa-group fa-2x text-dark" data-bs-toggle="modal"
                                        data-bs-target="#actionModal4"></i>
                                    <p class="small">Mail to Partner</p>
                                </div>
                                <div class="col-3 c-p">
                                    <i class="fa fa-file fa-2x ele-color" data-bs-toggle="modal"
                                        data-bs-target="#actionModal5"></i>
                                    <p class="small">Grievance Report</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="actionModal1" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="actionModalLabel">Actions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container text-center">
                            <div class="row g-3">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Customer Details
                                            </button>
                                        </h2>


                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <form>
                                                    <!-- First Row -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label for="name"
                                                                class="form-label text-start d-block">Name:</label>
                                                            <input type="text" id="name" class="form-control"
                                                                placeholder="Enter name">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="mobile"
                                                                class="form-label text-start d-block">Mobile No:</label>
                                                            <input type="number" id="mobile" class="form-control"
                                                                placeholder="Enter mobile number">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="optionalNo"
                                                                class="form-label text-start d-block">Optional
                                                                No:</label>
                                                            <input type="number" id="optionalNo" class="form-control"
                                                                placeholder="Enter optional number">
                                                        </div>
                                                    </div>

                                                    <!-- Second Row -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label for="email"
                                                                class="form-label text-start d-block">Email Id:</label>
                                                            <input type="email" id="email" class="form-control"
                                                                placeholder="Enter email">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="leadTime"
                                                                class="form-label text-start d-block">Lead Time:</label>
                                                            <input type="time" id="leadTime" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="leadDate"
                                                                class="form-label text-start d-block">Lead Date:</label>
                                                            <input type="date" id="leadDate" class="form-control">
                                                        </div>
                                                    </div>

                                                    <!-- Third Row -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label for="spancoStatus"
                                                                class="form-label text-start d-block">SPANCO
                                                                Status:</label>
                                                            <select id="spancoStatus" class="form-select">
                                                                <option value="suspect">Suspect</option>
                                                                <option value="prospect">Prospect</option>
                                                                <option value="analysis">Analysis</option>
                                                                <option value="negotiation">Negotiation</option>
                                                                <option value="closure">Closure</option>
                                                                <option value="order">Order</option>
                                                                <option value="lost">Lost</option>
                                                                <option value="not eligible">Not Eligible</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="lastRemark"
                                                                class="form-label text-start d-block">Lead
                                                                Remark:</label>
                                                            <select id="lastRemark" class="form-select">
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Remark Input -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label for="remark"
                                                                class="form-label text-start d-block">Remark:</label>
                                                            <textarea class="form-control" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- Fourth Row: Update Button -->
                                                    <div class="row mb-3">
                                                        <div class="col text-start">
                                                            <button type="button" class="custom-button">Update</button>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- Table -->
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr No.</th>
                                                                <th>SPANCO Remark</th>
                                                                <th>Lead Flow Remark</th>
                                                                <th>Date or Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Table rows can be dynamically added here -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Move Details
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <form>
                                                    <!-- First Row -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label for="movingFrom"
                                                                class="form-label text-start d-block">Moving
                                                                From:</label>
                                                            <input type="text" id="movingFrom" class="form-control"
                                                                placeholder="Enter location">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="movingTo"
                                                                class="form-label text-start d-block">Moving To:</label>
                                                            <input type="text" id="movingTo" class="form-control"
                                                                placeholder="Enter location">
                                                        </div>
                                                    </div>

                                                    <!-- Second Row -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label for="homeSize"
                                                                class="form-label text-start d-block">Home Size:</label>
                                                            <select id="homeSize" class="form-select">
                                                                <option value="1RK">1RK</option>
                                                                <option value="1BHK LITE">1BHK LITE</option>
                                                                <option value="1BHK HEAVY">1BHK HEAVY</option>
                                                                <option value="2BHK LITE">2BHK LITE</option>
                                                                <option value="2BHK HEAVY">2BHK HEAVY</option>
                                                                <option value="3BHK LITE">3BHK LITE</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="moveDate"
                                                                class="form-label text-start d-block">Move Date:</label>
                                                            <input type="date" id="moveDate" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="moveCity"
                                                                class="form-label text-start d-block">Move City:</label>
                                                            <select id="moveCity" class="form-select">
                                                                <option value="within">Within City</option>
                                                                <option value="inter">Inter City</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Third Row -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label for="city"
                                                                class="form-label text-start d-block">City:</label>
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
                                                        <div class="col-md-6">
                                                            <label for="timeSlot"
                                                                class="form-label text-start d-block">Time Slot:</label>
                                                            <select id="timeSlot" class="form-select">
                                                                <option value="8:00-10:00">8:00 AM - 10:00 AM</option>
                                                                <option value="10:00-12:00">10:00 AM - 12:00 PM</option>
                                                                <option value="12:00-2:00">12:00 PM - 2:00 PM</option>
                                                                <option value="2:00-4:00">2:00 PM - 4:00 PM</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Textareas in One Row -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label text-start d-block">Society
                                                                Restriction - From Location:</label>
                                                            <textarea class="form-control"
                                                                placeholder="Enter Remark"></textarea>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-start d-block">Society
                                                                Restriction - To Location:</label>
                                                            <textarea class="form-control"
                                                                placeholder="Enter Remark"></textarea>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label text-start d-block">Remark:</label>
                                                            <textarea class="form-control"
                                                                placeholder="Enter Remark"></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- Submit Button -->
                                                    <button type="button" class="custom-button">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Source Details
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="container">
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label for="source"
                                                                class="text-start d-block form-label">Source:</label>
                                                            <select id="source" class="form-select">
                                                                <option>elePLACe website</option>
                                                                <option>elePLACE Direct</option>
                                                                <option>elePLACE Google Campaign</option>
                                                                <option>My Gate</option>
                                                                <option>Apna Complex</option>
                                                                <option>Just Dial App</option>
                                                                <option>Just Dial Website</option>
                                                                <option>Home Shifters</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="text-start d-block form-label">Ticket
                                                                No:</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="lead_assign"
                                                                class="text-start d-block form-label">Lead Assigned
                                                                To:</label>
                                                            <select id="lead_assign" class="form-select">
                                                                <option>Own</option>
                                                                <option>Partner</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mt-2">
                                                        <div class="col-md-4">
                                                            <label for="lead_customer"
                                                                class="text-start d-block form-label">Lead
                                                                Manager:</label>
                                                            <select id="lead_customer" class="form-select">
                                                                <option>Nafisa</option>
                                                                <option>Pooja</option>
                                                                <option>Priya</option>
                                                                <option>Rupali</option>
                                                                <option>Parveen</option>
                                                                <option>Amol</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mt-2 ele-bg p-3">
                                                        <div class="col-md-4 mt-0">
                                                            <label class="text-start d-block form-label">ele Ops
                                                                Price:</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="col-md-4 mt-0">
                                                            <label
                                                                class="text-start d-block form-label">Insurance:</label>
                                                            <input type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mt-3 text-center">
                                                        <div class="col">
                                                            <button type="button" class="custom-button">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour">
                                                Patner Payment Details
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse"
                                            aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="4" class="text-center ele-bg">Patner Payment
                                                                Details</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Sr No.</th>
                                                            <th>Patner Name</th>
                                                            <th>Invoice No.</th>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data rows will go here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                aria-expanded="false" aria-controls="collapseFive">
                                                Move Confirmation Details
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse"
                                            aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="container">
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label class="text-start d-block form-label">ele
                                                                Quotation:</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="text-start d-block form-label">Pending
                                                                Payment:</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="text-start d-block form-label">Advance
                                                                Amount:</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mt-2">
                                                        <div class="col-md-4">
                                                            <label class="text-start d-block form-label">Payment
                                                                Date:</label>
                                                            <input type="date" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="pay_source"
                                                                class="text-start d-block form-label">Source:</label>
                                                            <select id="pay_source" class="form-select">
                                                                <option>Freecharge</option>
                                                                <option>PAYTM</option>
                                                                <option>ICICI</option>
                                                                <option>My Gate</option>
                                                                <option>Pikkoi</option>
                                                                <option>Others</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="text-start d-block form-label">Reference
                                                                No:</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mt-3 text-center">
                                                        <div class="col">
                                                            <button type="button" class="custom-button">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSix">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                aria-expanded="false" aria-controls="collapseSix">
                                                Payment Received
                                            </button>
                                        </h2>
                                        <div id="collapseSix" class="accordion-collapse collapse"
                                            aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="6" class="text-center ele-bg">Ele Quotation
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>Sr No.</th>
                                                            <th>Payment Date</th>
                                                            <th>Payment Source</th>
                                                            <th>Reference No.</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data rows will go here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSeventh">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSeventh"
                                                aria-expanded="false" aria-controls="collapseSeventh">
                                                Move Closure Instructions
                                            </button>
                                        </h2>
                                        <div id="collapseSeventh" class="accordion-collapse collapse"
                                            aria-labelledby="headingSeventh" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="container">
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label for="description"
                                                                class="text-start d-block form-label">Description:</label>
                                                            <select id="description" class="form-control">
                                                                <option>Deposit for Cartons</option>
                                                                <option>Transportation</option>
                                                                <option>Any other Packing Material</option>
                                                                <option>Assemble & Disassemble</option>
                                                                <option>Wood Crafting</option>
                                                                <option>Wall Dismounting</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label
                                                                class="text-start d-block form-label">Quantity:</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="text-start d-block form-label">Price:</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mt-2">
                                                        <div class="col-md-4">
                                                            <label for="responsibility"
                                                                class="text-start d-block form-label">Responsibility:</label>
                                                            <select id="responsibility" class="form-control">
                                                                <option>Sonal Talwar</option>
                                                                <option>Pooja</option>
                                                                <option>Parveen</option>
                                                                <option>Nafisa</option>
                                                                <option>Priya</option>
                                                                <option>Rupali</option>
                                                                <option>Amol</option>
                                                                <option>Sumit</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="text-start d-block form-label">Closure
                                                                Date:</label>
                                                            <input type="date" class="form-control">
                                                        </div>
                                                        <div class="col-md-4 d-flex align-items-end">
                                                            <button type="button" class="custom-button">Update</button>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Description</th>
                                                                    <th>Responsibility</th>
                                                                    <th>Quantity</th>
                                                                    <th>Deposit Price</th>
                                                                    <th>Closure Date</th>
                                                                    <th>Edit</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Data rows will go here -->
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
                </div>
            </div>
        </div>

        <!-- Generate LR -->
        <div class="modal fade" id="actionModal3" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <!-- Add LR Details -->
                            <div class="card-body">
                                <div class="w-100 py-4 mb-4">
                                    <h4 class="fs-2">Add LR Details</h4>
                                </div>

                                <form class="forms-sample">
                                    <!-- First Row -->
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">Driver Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Driver Name">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">Vehicle Number</label>
                                            <input type="text" class="form-control" placeholder="Enter Vehicle Number">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">Driver Mobile</label>
                                            <input type="text" class="form-control"
                                                placeholder="Optional Driver Mobile">
                                        </div>
                                    </div>

                                    <!-- Second Row -->
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">LR Date</label>
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">From</label>
                                            <input type="text" class="form-control" placeholder="Enter From">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">To</label>
                                            <input type="text" class="form-control" placeholder="Enter To">
                                        </div>
                                    </div>

                                    <!-- Checkbox for Insurance -->
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label class="fw-semibold">Insurance?</label>
                                            <div>
                                                <input type="radio" id="insuranceYes" name="insurance" value="yes"> Yes
                                                <input type="radio" id="insuranceNo" name="insurance" value="no"
                                                    checked> No
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Fourth Row (Hidden by default) -->
                                    <div class="row" id="insuranceDetails" style="display: none;">
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" placeholder="Enter Insurance">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" placeholder="Enter Insurance Value">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control"
                                                placeholder="Enter Insurance Company">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control"
                                                placeholder="Enter Insurance Amount">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" placeholder="Enter Metric Tone">
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mail To Patner -->
        <div class="modal fade" id="actionModal4" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <!-- Add LR Details -->
                            <div class="card-body">
                                <div class="w-100 py-4 mb-2">
                                    <h4 class="fs-2">Mail to Partner for Quote</h4>
                                </div>

                                <form class="forms-sample">
                                    <!-- First Row -->
                                    <div class="row">
                                        <div class="form-group">
                                            <select id="sortBy" class="form-select">
                                                <option selected disabled>Select</option>
                                                <option>Nakul Varma</option>
                                                <option>Adil Nadeem</option>
                                                <option>Sanket Parab</option>
                                                <option>Sonu Monu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Second Row -->
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <button class="ele-bg btn btn-height">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  Grievance Tracking  -->
        <div class="modal fade" id="actionModal5" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                                            <label class="fw-semibold">Select Home Size</label>
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
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">Moving Date</label>
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">Moving Time</label>
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
                                    </div>

                                    <!-- Third Row -->
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label class="fw-semibold">Source</label>
                                            <select class="form-select">
                                                <option value="Eleplace Website">elePLACE Website</option>
                                                <option value="elePLACE Direct">elePLACE Direct</option>
                                                <option value="elePLACE Google Campaign">elePLACE Google Campaign
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="fw-semibold">Move Type</label>
                                            <select class="form-select">
                                                <option value="Within City">Within City</option>
                                                <option value="Inter City">Inter City</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="fw-semibold">City</label>
                                            <select class="form-select">
                                                <option value="Mumbai">Mumbai</option>
                                                <option value="Bengaluru">Bengaluru</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="fw-semibold">State</label>
                                            <select class="form-select">
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
                                            <label class="fw-semibold">Service Lift</label>
                                            <select class="form-select">
                                                <option value="">Select Service Lift</option>
                                                <option value="Available">Available</option>
                                                <option value="Not Available">Not Available</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Fifth Row -->
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">Moving To</label>
                                            <input type="text" class="form-control" placeholder="Enter Location">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">Moving Floor No</label>
                                            <input type="text" class="form-control" placeholder="Enter Floor No">
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">Service Lift</label>
                                            <select class="form-select">
                                                <option value="">Select Service Lift</option>
                                                <option value="Available">Available</option>
                                                <option value="Not Available">Not Available</option>
                                            </select>
                                        </div>
                                    </div>


                                    <!-- Sixth Row -->
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label class="fw-semibold">Distance</label>
                                            <input type="text" class="form-control" placeholder="Enter Distance">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="fw-semibold">Remark</label>
                                            <input type="text" class="form-control" placeholder="Enter Remark">
                                        </div>
                                        <div
                                            class="col-md-3 d-flex flex-column align-items-center justify-content-center">
                                            <label class="fw-semibold" for="sendMail">Send Mail To Customer</label>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input custom-switch fs-2"
                                                    id="sendMail">
                                            </div>
                                        </div>
                                        <div
                                            class="col-md-3 d-flex flex-column align-items-center justify-content-center">
                                            <label class="fw-semibold" for="getSign">Get Sign</label>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input custom-switch fs-2"
                                                    id="getSign">
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <!-- Grievance Tracking -->
                            <div class="card-body">
                                <div class="w-100 ele-bg p-4 mb-4">
                                    <h4>Grievance Tracking</h4>
                                </div>

                                <form class="forms-sample">
                                    <!-- First Row -->
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="fw-semibold">Issue Description</label>
                                            <textarea class="form-control" rows="6"></textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="fw-semibold">Resolution Description</label>
                                            <textarea class="form-control" rows="6"></textarea>
                                        </div>
                                    </div>


                                    <!-- Second Row -->
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label class="fw-semibold">Status</label>
                                            <select class="form-select">
                                                <option value="all">Open</option>
                                                <option value="rk">Close</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Third Row -->
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <button class="ele-bg btn btn-height">Submit</button>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <button class="ele-bg btn btn-height">Back</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SPANCO Modal -->
        <div class="modal fade" id="actionModal6" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true"
            id="spanco_data">
            <div class="modal-dialog custom-modal-sm">
                <div class="modal-content animate__animated animate__fadeIn">
                    <div class="modal-header">
                        <div class="w-100 fs-6">
                            <h6 class="fw-bold mb-0">SPANCO</h6>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card" style="background: none;">
                            <div class="container">
                                <div class="row g-2">
                                    <!-- Card Template -->
                                    <div class="col-12 col-md-6 col-lg-3 animate__animated animate__zoomIn">
                                        <div class="p-3 border rounded text-white text-center fs-6 c-p suspect">
                                            <h6 class="mb-1">Suspect</h6>
                                            <hr class="my-1">
                                            <div class="d-flex w-100 gap-1 small">
                                                <div class="w-50 equal-height" id="pervious_month">
                                                    <div>Previous</div>
                                                    <button class="spanco-custom-button"
                                                        id="last-month-suspect">18</button>

                                                </div>
                                                <div class="w-50 equal-height" id="this_month">
                                                    <div>This Month</div>
                                                    <button class="spanco-custom-button"
                                                        id="thismonthSuspect">11</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 animate__animated animate__zoomIn">
                                        <div class="p-3 border rounded text-white text-center fs-6 c-p prospect">
                                            <h6 class="mb-1">Prospect</h6>
                                            <hr class="my-1">
                                            <div class="d-flex w-100 gap-1 small">
                                                <div class="w-50 equal-height">
                                                    <div>Previous</div>
                                                    <button class="spanco-custom-button"
                                                        id="p_pervious_month">12</button>
                                                </div>
                                                <div class="w-50 equal-height">
                                                    <div>This Month</div>
                                                    <button class="spanco-custom-button" id="p_this_month">35</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 animate__animated animate__zoomIn">
                                        <div class="p-3 border rounded text-white text-center fs-6 c-p negotiation"
                                            id="filterSuspect2">
                                            <h6 class="mb-1">Negotiation</h6>
                                            <hr class="my-1">
                                            <div class="d-flex w-100 gap-1 small">
                                                <div class="w-50 equal-height">
                                                    <div>Previous</div>
                                                    <button class="spanco-custom-button"
                                                        id="n_pervious_month">45</button>
                                                </div>
                                                <div class="w-50 equal-height">
                                                    <div>This Month</div>
                                                    <button class="spanco-custom-button" id="n_this_month">22</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 animate__animated animate__zoomIn">
                                        <div class="p-3 border rounded text-white text-center fs-6 c-p analysis"
                                            id="filterSuspect3">
                                            <h6 class="mb-1">Analysis</h6>
                                            <hr class="my-1">
                                            <div class="d-flex w-100 gap-1 small">
                                                <div class="w-50 equal-height">
                                                    <div>Previous</div>
                                                    <button class="spanco-custom-button"
                                                        id="a_pervious_month">55</button>
                                                </div>
                                                <div class="w-50 equal-height">
                                                    <div>This Month</div>
                                                    <button class="spanco-custom-button" id="a_this_month">32</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Cards -->
                                </div>
                                <div class="row g-2 mt-2">

                                    <div class="col-12 col-md-6 col-lg-3 animate__animated animate__zoomIn">
                                        <div class="p-3 border rounded text-white text-center fs-6 c-p closure"
                                            id="filterSuspect4">
                                            <h6 class="mb-1">Closure</h6>
                                            <hr class="my-1">
                                            <div class="d-flex w-100 gap-1 small">
                                                <div class="w-50 equal-height">
                                                    <div>Previous</div>
                                                    <button class="spanco-custom-button"
                                                        id="c_pervious_month">49</button>
                                                </div>
                                                <div class="w-50 equal-height">
                                                    <div>This Month</div>
                                                    <button class="spanco-custom-button" id="c_this_month">12</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 animate__animated animate__zoomIn">
                                        <div class="p-3 border rounded text-white text-center fs-6 c-p lost"
                                            id="filterSuspect6">
                                            <h6 class="mb-1">Lost</h6>
                                            <hr class="my-1">
                                            <div class="d-flex w-100 gap-1 small">
                                                <div class="w-50 equal-height">
                                                    <div>Previous</div>
                                                    <button class="spanco-custom-button"
                                                        id="l_pervious_month">25</button>
                                                </div>
                                                <div class="w-50 equal-height">
                                                    <div>This Month</div>
                                                    <button class="spanco-custom-button" id="l_this_month">13</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 animate__animated animate__zoomIn">
                                        <div class="p-3 border rounded text-white text-center fs-6 c-p order"
                                            id="filterSuspect5">
                                            <h6 class="mb-1">Order</h6>
                                            <hr class="my-1">
                                            <div class="d-flex w-100 gap-1 small">
                                                <div class="w-50 equal-height">
                                                    <div>Previous</div>
                                                    <button class="spanco-custom-button"
                                                        id="o_pervious_month">30</button>
                                                </div>
                                                <div class="w-50 equal-height">
                                                    <div>This Month</div>
                                                    <button class="spanco-custom-button" id="o_this_month">5</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-3 animate__animated animate__zoomIn">
                                        <div class="p-3 border rounded text-white text-center fs-6 c-p not-eligible"
                                            id="filterSuspect7">
                                            <h6 class="mb-1">Not Eligible</h6>
                                            <hr class="my-1">
                                            <div class="d-flex w-100 gap-1 small">
                                                <div class="w-50 equal-height">
                                                    <div>Previous</div>
                                                    <button class="spanco-custom-button"
                                                        id="Ne_pervious_month">13</button>
                                                </div>
                                                <div class="w-50 equal-height">
                                                    <div>This Month</div>
                                                    <button class="spanco-custom-button" id="Ne_this_month">149</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>