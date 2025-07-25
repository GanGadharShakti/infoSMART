<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <!-- Barcode List -->



                    <div class="card-body">
                        <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 w-50">Stored Barcodes</h4>
                            <div class="w-50 d-flex justify-content-center gap-5 align-items-center">
                                <a href="<?= base_url('barcode') ?>" class="btn custom-button gen-bord">+ Generate New</a>
                                <a href="<?= base_url('child-barcodes-view') ?>" class="btn custom-button gen-bord">per item Barcodes</a>
                            </div>
                        </div>
                        <form method="get" class="row mb-4 g-2">
                            <div class="col-md-5">
                                <input type="text" name="customer_name" class="form-control" placeholder="Search by Customer Name"
                                    value="<?= esc($filters['customer_name'] ?? '') ?>">
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="customer_id" class="form-control" placeholder="Search by Customer ID"
                                    value="<?= esc($filters['customer_id'] ?? '') ?>">
                            </div>
                            <div class="col-md-2 d-flex gap-2">
                                <button type="submit" class="btn btn-primary w-100">Search</button>
                            </div>
                        </form>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th>sr no.</th>
                                        <th>Customer ID</th>
                                        <th>Item Name</th>
                                        <th>Customer Name</th>
                                        <th>Rack Product ID</th>
                                        <th>Barcode Value</th>
                                        <th>Barcode</th>
                                        <th>Generated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($barcodes)): ?>
                                        <?php foreach ($barcodes as $index => $barcode): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= esc($barcode['customer_id'] ?? 'N/A') ?></td>
                                                <td><?= esc($barcode['item_name'] ?? 'N/A') ?></td>
                                                <td><?= esc($barcode['customer_name'] ?? 'N/A') ?></td>
                                                <td><?= esc($barcode['rack_product_id']) ?></td>
                                                <td><?= esc($barcode['barcode_value']) ?></td>
                                                <td>
                                                    <?php if (!empty($barcode['qr_image_path'])): ?>
                                                        <img src="<?= base_url($barcode['qr_image_path']) ?>"
                                                            alt="Barcode"
                                                            class="img-fluid border p-1 rounded"
                                                            style="width: 100px; object-fit: contain; cursor: pointer;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#barcodeModal"
                                                            data-img="<?= base_url($barcode['qr_image_path']) ?>">
                                                    <?php else: ?>
                                                        <span class="text-muted">No Image</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= date('d M Y, h:i A', strtotime($barcode['generated_at'])) ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-info view-child-btn"
                                                        data-inventory-id="<?= esc($barcode['rack_product_id']) ?>"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#childBarcodeModal">
                                                        View Items
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No barcodes found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal for barcode preview -->
                        <div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="barcodeModalLabel">Barcode Preview</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="" alt="Full Barcode" id="barcodePreview" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Child Barcode Modal -->
                        <div class="modal fade" id="childBarcodeModal" tabindex="-1" aria-labelledby="childBarcodeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Child Barcodes</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="childBarcodeContent">Loading...</div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Script for modal preview -->
                        <script>
                            const modalImg = document.getElementById('barcodePreview');
                            const thumbs = document.querySelectorAll('img[data-bs-toggle="modal"]');

                            thumbs.forEach(img => {
                                img.addEventListener('click', function() {
                                    const fullSrc = this.getAttribute('data-img');
                                    modalImg.setAttribute('src', fullSrc);
                                });
                            });
                        </script>
                        <script>
                            document.querySelectorAll('.view-child-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    const inventoryId = this.getAttribute('data-inventory-id');
                                    const contentDiv = document.getElementById('childBarcodeContent');
                                    contentDiv.innerHTML = 'Loading...';

                                    fetch(`<?= base_url('get-child-barcodes') ?>/${inventoryId}`)
                                        .then(response => response.text())
                                        .then(data => {
                                            contentDiv.innerHTML = data;
                                        })
                                        .catch(() => {
                                            contentDiv.innerHTML = '<p class="text-danger">Error loading child barcodes.</p>';
                                        });
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>