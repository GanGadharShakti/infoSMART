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
        'title' => "Total Order",
        'value' => $totalLeads ?? '0',
        'icon' => 'mdi-account-multiple-outline',
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