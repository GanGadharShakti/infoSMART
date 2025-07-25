<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <!-- inventory List -->



                    <div class="card-body">
                        <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 w-50">Inventory List</h4>
                            <div class="d-flex justify-content-center gap-5 align-items-center">
                                <a href="<?= base_url('barcode-search-page') ?>" class="btn custom-button gen-bord">Item search</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Product Box id</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($inventories)): ?>
                                    <?php foreach ($inventories as $i => $item): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= esc($item['item_name']) ?></td>
                                            <td><?= esc($item['quantity']) ?></td>
                                            <td><?= esc($item['id']) ?></td>
                                            <td><?= esc($item['inventory_status']) ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info view-child-btn"
                                                    data-inventory-id="<?= esc($item['id']) ?>"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#childBarcodeModal">
                                                    View Items
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No inventory found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
                </div>
            </div>
        </div>
    </div>


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