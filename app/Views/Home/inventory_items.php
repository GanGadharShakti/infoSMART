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

                </div>
            </div>
        </div>
    </div>