let searchType = "box";

function setSearchType(type) {
  searchType = type;
  $("#btnBox").toggleClass("btn-primary btn-outline-primary", type === "box");
  $("#btnItem").toggleClass("btn-primary btn-outline-primary", type === "item");
  $("#barcodeResults").html(""); // Clear results
}

function searchBarcode() {
  const value = $("#barcodeSearch").val().trim();
  if (value === "") return alert("Please enter a barcode.");

  let url = "";

  if (searchType === "box") {
    url = base_url + `/barcode-search/box/${value}`; // existing logic
  } else {
    url = base_url + `/child-barcodes-full/${value}`; // updated for inventory_id based child barcode
  }

  $.get(url, function (res) {
    if (res.status !== "success" && res.status !== "ok") {
      $("#barcodeResults").html(
        `<div class="alert alert-danger">${res.message}</div>`
      );
      return;
    }

    // Handle item (child barcode by inventory_id)
    if (searchType === "item") {
      const cust = res.customer;
      const barcodes = res.barcodes;

      if (!barcodes || barcodes.length === 0) {
        $("#barcodeResults").html(
          `<div class="alert alert-warning">No child barcodes found.</div>`
        );
        return;
      }

      let html = `
        <div class="alert alert-secondary shadow-sm border mb-4">
          <h5 class="mb-2">Customer Details</h5>
          <p class="mb-1"><strong>Customer ID:</strong> ${cust?.id || "N/A"}</p>
          <p class="mb-1"><strong>Name:</strong> ${
            cust?.customer_name || "N/A"
          }</p>
          <p class="mb-1"><strong>Phone:</strong> ${
            cust?.customer_mobile || "N/A"
          }</p>
          <p class="mb-0"><strong>Email:</strong> ${
            cust?.customer_email || "N/A"
          }</p>
        </div>
      `;

      barcodes.forEach((row, index) => {
        html += `
          <div class="card shadow-sm border mb-3">
            <div class="card-body">
              <h6 class="card-title mb-2">#${index + 1}</h6>
              <p class="mb-1"><strong>Barcode Value:</strong> ${
                row.child_barcode_value
              }</p>
              <p class="mb-1"><strong>Serial:</strong> ${
                row.serial_number || "N/A"
              }</p>
              <p class="mb-2"><strong>Rack ID:</strong> ${
                row.inventory_id || "N/A"
              }</p>
              <p class="mb-2"><strong>Rack ID:</strong> ${
                row.item_status || "N/A"
              }</p>
              <img src="${
                base_url + row.qr_image_path
              }" class="img-fluid img-thumbnail" style="max-width:150px; cursor:pointer;" onclick="window.open(this.src)">
            </div>
          </div>
        `;
      });

      $("#barcodeResults").html(html);
      return;
    }

    // Default for box barcode
    let html = `
      <div class="card shadow-sm border p-3">
        <h5 class="mb-3">Box Barcode Details</h5>
        <p class="mb-1"><strong>Customer Name:</strong> ${
          res.customer?.customer_name || "N/A"
        }</p>
        <p class="mb-1"><strong>Customer ID:</strong> ${
          res.customer?.id || "N/A"
        }</p>
        <p class="mb-1"><strong>Item Name:</strong> ${
          res.item?.item_name || "N/A"
        }</p>
        <p class="mb-1"><strong>Rack ID:</strong> ${
          res.barcode?.rack_product_id || "N/A"
        }</p>
        <p class="mb-1"><strong>Barcode Value:</strong> ${
          res.barcode?.barcode_value || res.barcode?.child_barcode_value
        }</p>
        <p class="mb-3"><strong>Serial:</strong> ${res.barcode?.id || "N/A"}</p>
        <img src="${
          base_url + res.barcode.qr_image_path
        }" class="img-fluid img-thumbnail" style="max-width:150px; cursor:pointer;" onclick="window.open(this.src)">
      </div>
    `;

    $("#barcodeResults").html(html);
  });
}
