<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Your Inventory</h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Assemble</th>
                                <th>Crating</th>
                                <th>Wall Dismount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($inventories)): ?>
                                <?php foreach ($inventories as $i => $item): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= esc($item['item_name']) ?></td>
                                        <td><?= esc($item['quantity']) ?></td>
                                        <td><?= $item['assemble_disassemble'] ? 'Yes' : 'No' ?></td>
                                        <td><?= $item['wood_crating'] ? 'Yes' : 'No' ?></td>
                                        <td><?= $item['wall_dismounting'] ? 'Yes' : 'No' ?></td>
                                        <td><?= esc($item['inventory_status']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No inventory found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>