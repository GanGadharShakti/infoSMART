<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <!-- Barcode Generator Form -->
                    <div class="card-body">
                        <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Generate Barcode</h4>
                            <a href="<?= base_url('barcode/list') ?>" class="btn custom-button gen-bord">All Barcodes</a>
                        </div>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('barcode/generate') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Rack Product ID</label>
                                    <input type="number" name="rack_product_id" class="form-control" placeholder="Enter Rack Product ID" required>
                                    <small class="text-danger error-rack_product_id"></small>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Barcode Value</label>
                                    <input type="text" name="barcode_value" class="form-control" placeholder="Enter Barcode Value" required>
                                    <small class="text-danger error-barcode_value"></small>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-4">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100">Generate Barcode</button>
                                </div>
                            </div>
                        </form>
                    </div>
