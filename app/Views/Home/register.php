<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <!-- Customer Moving Details -->
                    <div class="card-body">
                            <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">User Registration</h4>
                            <a href="<?= base_url('allemployee') ?>" class=" btn custom-button gen-bord">All Employees</a>
                        </div>

                        <form id="registerForm">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                    <small class="text-danger error-name"></small>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                    <small class="text-danger error-email"></small>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" placeholder="Enter Number ">
                                    <small class="text-danger error-phone_number"></small>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                    <small class="text-danger error-password"></small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Warehouse</label>
                                    <select name="assign_location" class="form-select">
                                        <option value="">Select Warehouse</option>
                                        <?php foreach ($warehouses as $wh): ?>
                                            <option value="<?= esc($wh['city']) ?>"><?= esc($wh['city']) ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                    <small class="text-danger error-assign_location"></small>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>User Role</label>
                                    <select name="user_role" class="form-select">
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                    </select>
                                    <small class="text-danger error-user_role"></small>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-3">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100">Register</button>
                                </div>
                            </div>
                        </form>

                        <div class="alert mt-3 d-none" id="successMessage"></div>
                    </div>