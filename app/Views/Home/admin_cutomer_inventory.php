<div class="main-panel">
  <div class="content-wrapper">

    <!-- Header -->
    <div class="row" style="background-color: white;">
      <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Customer Inventory</h4>
        <a href="<?= base_url('/dashboard') ?>" class="btn custom-button gen-bord">Back to Leads</a>
      </div>

      <!-- Flash Message -->
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>

      <!-- Add Inventory Form -->
      <form method="post" action="<?= base_url('/inventory/add') ?>" class="mb-4">
        <input type="hidden" name="upload_inventory_id" value="<?= $leadId ?>">
        <div class="row g-2 mb-3">
          <div class="col-md-2"><input class="form-control" name="item_name" placeholder="Item Name" required></div>
          <div class="col-md-2"><input class="form-control" name="quantity" placeholder="Quantity" required></div>
          <!-- <div class="col-md-2"><input class="form-control" name="assemble" placeholder="Assemble"></div> -->
          <!-- <div class="col-md-2"><input class="form-control" name="crating" placeholder="Crating"></div> -->
          <!-- <div class="col-md-2"><input class="form-control" name="dismounting" placeholder="Dismounting"></div> -->
          <div class="col-md-2"><button class="btn btn-success w-100">Add Item</button></div>
        </div>
      </form>

      <!-- Inventory Table -->
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>id</th>
              <th>Item Name</th>
              <th>Quantity</th>
              <!-- <th>Assemble</th>
              <th>Crating</th>
              <th>Dismounting</th> -->
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($inventory)): ?>
              <?php foreach ($inventory as $index => $item): ?>
                <tr>
                  <td><?= $index + 1 ?></td>
                  <td><?= esc($item->item_name ?? '-') ?></td>
                  <td><?= esc($item->quantity ?? '-') ?></td>

                  <td>
                    <!-- Edit Button (opens modal) -->
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal<?= $item->id ?>">
                      Edit
                    </button>

                    <!-- Delete Form -->
                    <form action="<?= base_url('/inventory/delete/' . $item->id) ?>" method="get" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                  </td>
                </tr>

                <!-- Edit Modal -->

                <!-- Edit Inventory Modal -->
                <div class="modal fade" id="editModal<?= $item->id ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $item->id ?>" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <form action="<?= base_url('inventory/update/' . $item->id) ?>" method="post">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel<?= $item->id ?>">Edit Inventory Item</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body row g-3">
                          <!-- Optional: Upload Inventory ID -->
                          <input type="hidden" name="upload_inventory_id" value="<?= $leadId ?>">

                          <div class="col-md-4">
                            <label class="form-label">Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="<?= esc($item->item_name) ?>" required>
                          </div>

                          <div class="col-md-2">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="quantity" value="<?= esc($item->quantity) ?>" required>
                          </div>


                        </div>

                        <div class="modal-footer mt-3">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-success">Update Item</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

      </div>

    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="7" class="text-center text-muted">No inventory found for this customer.</td>
    </tr>
  <?php endif; ?>
  </tbody>
  </table>
    </div>
  </div>
</div>
</div>