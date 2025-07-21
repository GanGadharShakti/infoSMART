<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <!-- City (Warehouse) Form -->
                    <div class="card-body">
                        <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"><?= isset($warehouse) ? 'Edit City' : 'Create City' ?></h4>
                            <a href="<?= base_url('warehouse') ?>" class="btn custom-button gen-bord">All Cities</a>
                        </div>

                        <form action="<?= isset($warehouse) ? base_url('warehouse/update/' . $warehouse['id']) : base_url('warehouse/store') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>City Name</label>
                                    <input type="text" name="city_name" class="form-control" placeholder="Enter City Name" value="<?= isset($warehouse) ? esc($warehouse['city_name']) : '' ?>">
                                    <small class="text-danger error-city_name"></small>
                                </div>

                                <!-- <div class="col-md-6 form-group">
                                    <label>Slug</label>
                                    <input type="text" name="slug" class="form-control" placeholder="Enter Slug" value="<?= isset($warehouse) ? esc($warehouse['slug']) : '' ?>">
                                    <small class="text-danger error-slug"></small>
                                </div> -->

                                <div class="col-md-6 form-group">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact_number" class="form-control" placeholder="Enter Contact Number" value="<?= isset($warehouse) ? esc($warehouse['contact_number']) : '' ?>">
                                    <small class="text-danger error-contact_number"></small>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?= isset($warehouse) ? esc($warehouse['email']) : '' ?>">
                                    <small class="text-danger error-email"></small>
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
                </div>
            </div>
        </div>
    </div>
</div>