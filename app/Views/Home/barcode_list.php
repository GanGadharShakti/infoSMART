<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <!-- Barcode List -->
                    <div class="card-body">
                        <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Stored Barcodes</h4>
                            <a href="<?= base_url('barcode') ?>" class="btn custom-button gen-bord">+ Generate New</a>
                        </div>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Rack Product ID</th>
                                        <th>Barcode Value</th>
                                        <th>Barcode Image</th>
                                        <th>Generated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($barcodes)): ?>
                                        <?php foreach ($barcodes as $index => $barcode): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= esc($barcode['rack_product_id']) ?></td>
                                                <td><?= esc($barcode['barcode_value']) ?></td>
                                                <td>
                                                    <?php if (!empty($barcode['qr_image_path'])): ?>
                                                        <img src="<?= base_url($barcode['qr_image_path']) ?>" height="60" alt="barcode">
                                                    <?php else: ?>
                                                        <span class="text-muted">No Image</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= date('d M Y, h:i A', strtotime($barcode['generated_at'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No barcodes found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
