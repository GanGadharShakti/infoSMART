<div class="container mt-4">
    <h4>Child Barcodes for Inventory ID: <?= esc($inventoryId) ?></h4>

    <?php if (!empty($childBarcodes)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Serial Number</th>
                    <th>Child Barcode</th>
                    <th>QR Image</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($childBarcodes as $index => $child): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($child['serial_number']) ?></td>
                        <td><?= esc($child['child_barcode_value']) ?></td>
                        <td>
                            <?php if (!empty($child['qr_image_path'])): ?>
                                <img src="<?= base_url($child['qr_image_path']) ?>" style="width:80px;">
                            <?php else: ?>
                                <span class="text-muted">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($child['item_status']) ?></td>
                        <td><?= date('d M Y, h:i A', strtotime($child['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">No child barcodes found.</p>
    <?php endif; ?>
</div>