<div class="main-panel">
  <div class="content-wrapper">
    <!-- Header -->
    <div class="row" style="background-color: white;">
      <div class="w-100 ele-bg p-4 mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Customer Inventory</h4>
        <a href="<?= base_url('/dashboard') ?>" class="btn custom-button gen-bord">Back to Leads</a>
      </div>

      <!-- Inventory Table -->
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Item Name</th>
              <th>Quantity</th>
              <th>Assemble</th>
              <th>Crating</th>
              <th>Dismounting</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($inventory)): ?>
              <?php foreach ($inventory as $index => $item): ?>
                <tr>
                  <td><?= $index + 1 ?></td>
                  <td><?= esc($item->item_name ?? '-') ?></td>
                  <td><?= esc($item->quantity ?? '-') ?></td>
                  <td><?= esc($item->assemble ?? '-') ?></td>
                  <td><?= esc($item->crating ?? '-') ?></td>
                  <td><?= esc($item->dismounting ?? '-') ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center text-muted">No inventory found for this customer.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
