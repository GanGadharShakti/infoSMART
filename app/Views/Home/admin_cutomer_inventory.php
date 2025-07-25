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
                    <!-- Generate Barcode Button -->
                    <button class="btn btn-sm btn-warning generate-barcode-btn"
                      data-id="<?= $item->id ?>"
                      data-itemname="<?= esc($item->item_name) ?>"
                      data-quantity="<?= esc($item->quantity) ?>">
                      Generate Barcode
                    </button>
                  </td>
                </tr>
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


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const generateButtons = document.querySelectorAll('.generate-barcode-btn');

    generateButtons.forEach(button => {
      button.addEventListener('click', function() {
        const itemId = this.dataset.id;
        const itemName = this.dataset.itemname;
        const quantity = this.dataset.quantity;

        if (confirm(`Generate parent and ${quantity} child barcodes for "${itemName}"?`)) {
          fetch(`<?= base_url('generate-customer-barcode') ?>`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
              },
              body: JSON.stringify({
                item_id: itemId,
                item_name: itemName,
                quantity: quantity
              })
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                alert('Barcodes generated successfully!');
                location.reload();
              } else {
                alert('Error: ' + data.message);
              }
            })
            .catch(err => {
              console.error('Error:', err);
              alert('An error occurred while generating barcodes.');
            });
        }
      });
    });
  });
</script>