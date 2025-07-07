<div class="main-panel">
    <div class="content-wrapper">
        <div class="table-responsive">
            <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Employee</h4>
                <a href="<?= base_url('allemployee') ?>" class="btn custom-button gen-bord">Back to List</a>
            </div>

            <form action="<?= base_url('allemployee/update/' . $user['user_id']) ?>" method="post" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="<?= esc($user['address']) ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Assign Location</label>
                    <input type="text" name="assign_location" class="form-control" value="<?= esc($user['assign_location']) ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">User Role</label>
                    <select name="user_role" class="form-select">
                        <option value="admin" <?= $user['user_role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="manager" <?= $user['user_role'] === 'manager' ? 'selected' : '' ?>>Manager</option>
                        <option value="telecaller" <?= $user['user_role'] === 'telecaller' ? 'selected' : '' ?>>Telecaller</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $user['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>