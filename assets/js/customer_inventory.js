$(document).on("click", ".action-icon", function () {
  const leadId = $(this).data("id");

  $("#customerDetails").html("Loading...");
  $("#customerInventory").html("Loading...");

  $.ajax({
    url: `${base_url}leads/customer-inventory/${leadId}`,
    type: "GET",
    dataType: "json",
    success: function (response) {
      if (response.status === "success") {
        const c = response.customer;

        // Render customer info
        const customerContent = `
          <p><strong>Name:</strong> ${c.name}</p>
          <p><strong>Email:</strong> ${c.email}</p>
          <p><strong>Phone:</strong> ${c.phone}</p>
          <p><strong>Address:</strong> ${c.address || "-"}</p>
          <p><strong>City:</strong> ${c.city || "-"}</p>
        `;
        $("#customerDetails").html(customerContent);

        // Render inventory info
        const inventory = response.inventory;
        if (inventory.length > 0) {
          let inventoryTable = `
            <table class="table table-bordered table-striped mt-3">
              <thead>
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
          `;

          inventory.forEach((item, index) => {
            inventoryTable += `
              <tr>
                <td>${index + 1}</td>
                <td>${item.item_name}</td>
                <td>${item.quantity}</td>
                <td>${item.assemble}</td>
                <td>${item.crating}</td>
                <td>${item.dismounting}</td>
              </tr>
            `;
          });

          inventoryTable += `</tbody></table>`;
          $("#customerInventory").html(inventoryTable);
        } else {
          $("#customerInventory").html("<p>No inventory data available.</p>");
        }
      } else {
        $("#customerDetails").html("Customer not found.");
        $("#customerInventory").html("No inventory found.");
      }
    },
    error: function () {
      $("#customerDetails").html("Error fetching customer.");
      $("#customerInventory").html("Error fetching inventory.");
    }
  });
});
