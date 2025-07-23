<div class="main-panel">
    <div class="content-wrapper">
        <div class="card-body">
            <div class="w-100 ele-bg p-4 mb-4">
                <h4>Child Barcodes</h4>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Barcode</th>
                        <th>Serial Number</th>
                        <th>Status</th>
                        <th>QR Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($childBarcodes)) : ?>
                        <?php foreach ($childBarcodes as $key => $barcode) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= esc($barcode['child_barcode_value']) ?></td>
                                <td><?= esc($barcode['serial_number']) ?></td>
                                <td><?= esc(ucfirst($barcode['item_status'])) ?></td>
                                <td>
                                    <?php if (!empty($barcode['qr_image_path'])): ?>
                                        <img src="<?= base_url('uploads/barcodes/' . $barcode['qr_image_path']) ?>" alt="QR Code" height="50">
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="5" class="text-center">No child barcodes found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
