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
            <strong>Email:</strong> ${cust.customer_email || "N/A"}<br>
            <strong>City:</strong> ${cust.moving_from || "N/A"}
          </div>
        `);
      }

      // ✅ Show barcodes
      const data = res.barcodes;
      if (!data || data.length === 0) {
        $("#noDataMsg").text("No child barcodes found.").show();
        return;
      }

      // for in
      let html = "";
      data.forEach((row, index) => {
        if (row.item_status !== "in") return; // ⛔ skip if not "in"
        html += `
          <tr>
              <td>${index + 1}</td>
              <td>${row.child_barcode_value}</td>
              <td>${row.serial_number}</td>
              <td>
               <img style="cursor:pointer" src="${
                 base_url + row.qr_image_path
               }" height="50" class="img-thumbnail  barcode-thumb" />

                  
              </td>
              <td>${row.item_status}</td>

              <td>
                  <button class="btn btn-sm btn-danger" onclick="deleteChildBarcode(${
                    row.id
                  }, '${inventoryId}')">
                  
                  Out
                  </button>
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

function searchChildBarcodesout() {
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
            <strong>Email:</strong> ${cust.customer_email || "N/A"}<br>
          </div>
        `);
      }

      // ✅ Show barcodes
      const data = res.barcodes;
      if (!data || data.length === 0) {
        $("#noDataMsg").text("No child barcodes found.").show();
        return;
      }

      // for in
      let html = "";
      data.forEach((row, index) => {
        if (row.item_status !== "out") return; // ⛔ skip if not "in"
        html += `
          <tr>
              <td>${index + 1}</td>
              <td>${row.child_barcode_value}</td>
              <td>${row.serial_number}</td>
              <td>
               <img style="cursor:pointer" src="${
                 base_url + row.qr_image_path
               }" height="50" class="img-thumbnail  barcode-thumb" />

                  
              </td>
              <td>${row.item_status}</td>

              <td>
                  <button class="btn btn-sm btn-danger" onclick="deleteChildBarcode(${
                    row.id
                  }, '${inventoryId}')">
                  
                  Out
                  </button>
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
  if (!confirm("Are you sure you want to mark this item as OUT?")) return;

  $.ajax({
    url: base_url + `/child-barcodes/mark-out/${id}`, // updated route
    method: "POST", // use POST, not DELETE
    success: function (res) {
      if (res.status === "success") {
        searchChildBarcodes(); // refresh list
      } else {
        alert("Failed to mark as out.");
      }
    },
    error: function () {
      alert("Error while marking as out.");
    },
  });
}

// Click event to view full image in modal
$(document).on("click", ".barcode-thumb", function () {
  const fullImageUrl = $(this).attr("src");
  $("#barcodeFullImage").attr("src", fullImageUrl);
  $("#barcodeModal").modal("show");
});

function searchItemBarcodes() {
  const inventoryId = $("#barcodeSearch").val().trim();

  if (inventoryId === "") {
    alert("Please enter Inventory ID.");
    return;
  }

  // Clear previous results
  $("#barcodeResults").html("");

  $.ajax({
    url: base_url + `/child-barcodes-full/${inventoryId}`, // Must be defined in your route/controller
    method: "GET",
    dataType: "json",
    success: function (res) {
      if (res.status === "not_found") {
        $("#barcodeResults").html(
          `<div class="alert alert-warning">Inventory ID not found.</div>`
        );
        return;
      }

      // Customer info
      const cust = res.customer;
      let custHtml = "";
      if (cust) {
        custHtml = `
          <div class="card p-3 mb-3 border">
            <h5>Customer Info</h5>
            <p><strong>ID:</strong> ${cust.id}</p>
            <p><strong>Name:</strong> ${cust.customer_name}</p>
            <p><strong>Email:</strong> ${cust.customer_email}</p>
            <p><strong>Phone:</strong> ${cust.customer_mobile}</p>
          </div>
        `;
      }

      // Child barcodes
      const barcodes = res.barcodes || [];
      if (barcodes.length === 0) {
        $("#barcodeResults").html(
          custHtml +
            `<div class="alert alert-info">No child barcodes found.</div>`
        );
        return;
      }

      let tableHtml = `
        <table class="table table-bordered table-hover">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Barcode</th>
              <th>Serial No</th>
              <th>QR Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
      `;

      barcodes.forEach((row, index) => {
        tableHtml += `
          <tr>
            <td>${index + 1}</td>
            <td>${row.child_barcode_value}</td>
            <td>${row.serial_number}</td>
            <td>
              <img src="${
                base_url + row.qr_image_path
              }" class="img-thumbnail barcode-thumb" style="height: 50px; cursor:pointer;" />
            </td>
            <td>
              <button class="btn btn-danger btn-sm" onclick="deleteChildBarcode(${
                row.id
              }, '${inventoryId}')">Out</button>
            </td>
          </tr>
        `;
      });

      tableHtml += "</tbody></table>";

      $("#barcodeResults").html(custHtml + tableHtml);
    },
    error: function () {
      $("#barcodeResults").html(
        `<div class="alert alert-danger">Failed to fetch data. Please try again.</div>`
      );
    },
  });
}
function searchBarcode() {
  const value = $("#barcodeSearch").val().trim();
  if (value === "") return alert("Please enter a barcode.");

  if (searchType === "item") {
    searchItemBarcodes(); // new function added above
    return;
  }

  const url = base_url + `/barcode-search/${searchType}/${value}`;
  // ... (rest logic for box barcode already written)
}
