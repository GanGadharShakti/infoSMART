

<div class="container mt-4">
  <h4>Order Leads Assigned to You</h4>
  <table class="table table-bordered" id="orderLeadsTable">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Customer Name</th>
        <th>Mobile</th>
        <th>City</th>
        <th>State</th>
        <th>Status</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <!-- Data will be loaded via AJAX -->
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
$(document).ready(function () {
    fetchOrderLeads();
});

function fetchOrderLeads() {
    $.ajax({
        url: "<?= base_url('manager/fetch-order-leads') ?>",
        method: "GET",
        dataType: "json",
        success: function (response) {
            let rows = '';
            if (response.length > 0) {
                response.forEach(function (lead) {
                    rows += `
                        <tr>
                            <td>${lead.id}</td>
                            <td>${lead.customer_name}</td>
                            <td>${lead.customer_mobile}</td>
                            <td>${lead.city}</td>
                            <td>${lead.state}</td>
                            <td><span class="badge bg-success">${lead.spanco}</span></td>
                            <td>${lead.created_at}</td>
                        </tr>`;
                });
            } else {
                rows = '<tr><td colspan="7" class="text-center">No order leads found.</td></tr>';
            }
            $('#orderLeadsTable tbody').html(rows);
        }
    });
}
</script>
<?= $this->endSection() ?>
