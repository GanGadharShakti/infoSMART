<div class="content-wrapper">
    <div class="container-fluid py-4">
        <h4 class="mb-4">Storage Units</h4>
        <a href="<?= base_url('storage-units/create') ?>" class="btn btn-primary mb-3">Add Storage Unit</a>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Short Title</th>
                    <th>City</th>
                    <th>Price</th>
                    <th>Sq Ft</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($units as $unit): ?>
                    <tr>
                        <td><?= $unit['id'] ?></td>
                        <td><?= esc($unit['short_title']) ?></td>
                        <td><?= esc($unit['city_id']) ?></td>
                        <td><?= esc($unit['price']) ?></td>
                        <td><?= esc($unit['sq_ft']) ?></td>
                        <td>
                            <a href="<?= base_url('storage-units/edit/' . $unit['id']) ?>" class="btn btn-sm btn-info">Edit</a>
                            <a href="<?= base_url('storage-units/delete/' . $unit['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            <button class="btn btn-sm btn-secondary" onclick='showViewModal(<?= json_encode($unit) ?>)'>View</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Unit Details</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="unitDetailsList"></ul>
            </div>
        </div>
    </div>
</div>

<script>
    function showViewModal(data) {
        const list = document.getElementById('unitDetailsList');
        list.innerHTML = '';
        for (let key in data) {
            if (data.hasOwnProperty(key)) {
                const li = document.createElement('li');
                li.className = "list-group-item";
                li.textContent = `${key.replaceAll('_', ' ')}: ${data[key]}`;
                list.appendChild(li);
            }
        }
        new bootstrap.Modal(document.getElementById('viewModal')).show();
    }
</script>