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
                                        <th>Barcode</th>
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

                        <!-- Script for modal preview -->
                        <script>
                            const modalImg = document.getElementById('barcodePreview');
                            const thumbs = document.querySelectorAll('img[data-bs-toggle="modal"]');

                            thumbs.forEach(img => {
                                img.addEventListener('click', function () {
                                    const fullSrc = this.getAttribute('data-img');
                                    modalImg.setAttribute('src', fullSrc);
                                });
                            });
                        </script>

                    </div>
