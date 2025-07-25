<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Mobile</th>
      <th>Moving From</th>
      <th>Moving To</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($leads as $lead): ?>
    <tr>
      <td><?= $lead->id ?></td>
      <td><?= $lead->customer_name ?></td>
      <td><?= $lead->customer_mobile ?></td>
      <td><?= $lead->moving_from ?></td>
      <td><?= $lead->moving_to ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
