<div class="main-panel">
    <div class="content-wrapper">
        <!-- Table starts from here -->
        <div class="row" style="background-color: white;overflow:scroll">
            <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">All Warehouse List</h4>
                <a href="<?= base_url('warehouse/create') ?>" class="btn custom-button gen-bord">Add Warehouse</a>
            </div>
            <table id="dataTable" class="display table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>State</th>
                        <th>slug</th>
                        <th>Action</th> <!-- Action Column -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($warehouses as $warehouse): ?>
                        <tr>
                            <td><?= esc($warehouse['id']) ?></td>
                            <td><?= esc($warehouse['city_name']) ?></td>
                            <td><?= esc($warehouse['slug']) ?></td>
                            <td>
                                <a href="<?= base_url('warehouse/edit/' . $warehouse['id']) ?>">
                                    <i class="fa fa-edit fa-2x ele-color c-p"></i>
                                </a>
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
