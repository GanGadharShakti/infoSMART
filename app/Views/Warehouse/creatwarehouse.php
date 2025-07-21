<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <!-- Warehouse Details -->
                    <div class="card-body">
                        <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"><?= isset($warehouse) ? 'Edit Warehouse' : 'Create Warehouse' ?></h4>
                            <a href="<?= base_url('warehouse') ?>" class="btn custom-button gen-bord">All Warehouses</a>
                        </div>

                        <form action="<?= isset($warehouse) ? base_url('warehouse/update/' . $warehouse['warehouse_id']) : base_url('warehouse/store') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" placeholder="Enter State" value="<?= isset($warehouse) ? esc($warehouse['state']) : '' ?>">
                                    <small class="text-danger error-state"></small>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" placeholder="Enter City" value="<?= isset($warehouse) ? esc($warehouse['city']) : '' ?>">
                                    <small class="text-danger error-city"></small>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-3">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <?= isset($warehouse) ? 'Update' : 'Create' ?>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="alert mt-3 d-none" id="successMessage"></div>
                    </div>
