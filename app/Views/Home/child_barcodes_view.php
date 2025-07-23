<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <!-- Barcode List -->
                    <div class="card-body">
                        <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Stored Barcodes</h4>

                            <a href="<?= base_url('barcode/list') ?>" class="btn custom-button gen-bord">Box barcode</a>

                        </div>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <!-- 🔍 Search Child Barcodes -->
                        <div class="input-group mb-3">
                            <input type="text" id="inventorySearch" class="form-control" placeholder="Enter Inventory ID...">
                            <button class="btn btn-primary" onclick="searchChildBarcodes()">Search</button>
                        </div>

                        <!-- Optional: Message if nothing is found -->
                        <div id="noDataMsg" class="text-muted text-center mt-3" style="display: none;">
                            No child barcodes found for this inventory ID.
                        </div>

                        <!-- 👇 Child Barcode Result Table -->



                        <!-- Customer Details Block -->
                        <div class=" py-2 d-flex justify-content-between">
                            <div id="customerDetails" class="mb-3 ">
                            </div>
                            <div>
                                <!-- <input type="text" id="inventorySearch" class="form-control" placeholder="Enter Inventory ID..."> -->
                                <button onclick="searchChildBarcodesout()" class=" btn btn-danger">Out Items</button>
                            </div>
                        </div>

                        <!-- Customer Details Block close -->

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered" id="childBarcodesTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Child Barcode</th>
                                        <th>Serial No</th>
                                        <th>Barcode</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>


                        <!-- Modal for barcode preview -->



                        <!-- Barcode Full Image Modal -->
                        <div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Full Barcode Image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img id="barcodeFullImage" src="" class="img-fluid" alt="Barcode Image">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Barcode Preview Modal -->
                        <div class="modal fade" id="barcodePreviewModal" tabindex="-1" aria-labelledby="barcodePreviewModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Barcode Preview</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="" alt="Barcode Image" class="img-fluid" />
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