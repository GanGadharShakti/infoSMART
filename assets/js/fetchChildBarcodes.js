



function searchChildBarcodes() {
  const inventoryId = $("#inventorySearch").val().trim();

  if (inventoryId === "") {
    alert("Please enter Inventory ID.");
    return;
  }

  // Clear previous results
  $("#childBarcodesTable tbody").html("");
  $("#noDataMsg").hide();
  $("#customerDetails").html(""); // clear customer info

  $.ajax({
    url: base_url + `/child-barcodes-full/${inventoryId}`, // new updated full fetch route
    method: "GET",
    dataType: "json",
    success: function (res) {
      if (res.status === "not_found") {
        $("#noDataMsg").text("Inventory ID not found.").show();
        return;
      }

      // ✅ Show customer details
      const cust = res.customer;
      if (cust) {
        $("#customerDetails").html(`
          <div class="alert alert-light border mb-3">
            <strong>Customer ID :</strong> ${cust.id || "N/A"}<br>
            <strong>Name:</strong> ${cust.customer_name || "N/A"}<br>
            <strong>Phone:</strong> ${cust.customer_mobile || "N/A"}<br>
            <strong>Email:</strong> ${cust.customer_email  || "N/A"}
          </div>
        `);
      }

      // ✅ Show barcodes
      const data = res.barcodes;
      if (!data || data.length === 0) {
        $("#noDataMsg").text("No child barcodes found.").show();
        return;
      }

      let html = "";
      data.forEach((row, index) => {
        html += `
          <tr>
              <td>${index + 1}</td>
              <td>${row.child_barcode_value}</td>
              <td>${row.serial_number}</td>
              <td>
                  <img src="${
                   base_url+ row.qr_image_path
                  }" height="50" class="img-thumbnail" />
                  
              </td>
              <td>
                  <button class="btn btn-sm btn-danger" onclick="deleteChildBarcode(${
                    row.id
                  }, '${inventoryId}')">Out</button>
              </td>
          </tr>
        `;
      });

      $("#childBarcodesTable tbody").html(html);
    },
    error: function () {
      alert(
        "Failed to fetch data. Make sure the inventory ID exists and your route is working."
      );
    },
  });
}

// Delete child barcode by ID
function deleteChildBarcode(id, inventoryId) {
  if (!confirm("Are you sure you want to delete this child barcode?")) return;

  $.ajax({
    url: base_url + `/child-barcodes/delete/${id}`,
    method: "DELETE",
    success: function (res) {
      if (res.status === "deleted") {
        searchChildBarcodes(); // refresh list
      } else {
        alert("Failed to delete.");
      }
    },
    error: function () {
      alert("Error while deleting.");
    },
  });
}
