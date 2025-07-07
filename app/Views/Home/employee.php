<div class="main-panel">
    <div class="content-wrapper">
        <!-- Table starts from here  -->
        <div class="row" style="background-color: white;overflow:scroll">
            <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">All Employee List</h4>
                <a href="<?= base_url('register') ?>" class="btn custom-button gen-bord">Add Employee</a>
            </div>
            <table id="dataTable" class="display table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th >Username</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>User Role</th>
                        <th>Assign Location</th>
                        <th>Status</th>
                        <th>Action</th> <!-- NEW COLUMN -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>

                            <td><?= esc($user['user_id']) ?></td>
                            <td><?= esc($user['name']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td><?= esc($user['address']) ?></td>
                            <td><?= esc($user['user_role']) ?></td>
                            <td><?= esc($user['assign_location']) ?></td>
                            <td><?= esc($user['status']) ?></td>
                            <td class="text-center">
                                <i class="fa fa-edit fa-2x ele-color c-p user-action-icon"
                                    data-id="<?= $user['user_id'] ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#userActionModal"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="pagination-container">
                <ul id="pagination" class="pagination">
                    <!-- Pagination buttons will be dynamically generated here -->
                </ul>
            </div>
        </div>

        <!-- User Action Modal -->
        <div class="modal fade" id="userActionModal" tabindex="-1" aria-labelledby="userActionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userActionModalLabel">User Actions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container text-center">
                            <div class="row g-3">
                                <div class="col-4 c-p">
                                    <i class="fa fa-pencil-square-o fa-2x ele-color" id="editUserBtn"></i>
                                    <p class="small">Edit</p>
                                </div>
                                <div class="col-4 c-p">
                                    <i class="fa fa-trash fa-2x text-danger" id="deleteUserBtn"></i>
                                    <p class="small">Delete</p>
                                </div>
                                <div class="col-4 c-p">
                                    <i class="fa fa-eye fa-2x text-primary" id="viewUserBtn"></i>
                                    <p class="small">View</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/js/employeupdate.js') ?>"></script>