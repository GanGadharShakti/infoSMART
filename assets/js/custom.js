// For Add LR Details Insurance
const insuranceYes = document.getElementById("insuranceYes");
const insuranceNo = document.getElementById("insuranceNo");
const insuranceDetails = document.getElementById("insuranceDetails");




insuranceYes.addEventListener("change", function () {
  if (insuranceYes.checked) {
    insuranceDetails.style.display = "flex";
  }
});

insuranceNo.addEventListener("change", function () {
  if (insuranceNo.checked) {
    insuranceDetails.style.display = "none";
  }
});

$(document).ready(function () {
  $("#addRowBtn").on("click", function () {
    $("#dynamicRowsContainer").append(`
          <div class="row dynamic-row">
              <div class="col-md-3 form-group">
                  <label class="fw-semibold">Item Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name">
              </div>
              <div class="col-md-2 form-group">
                  <label class="fw-semibold">Quantity</label>
                  <input type="text" class="form-control" placeholder="Enter Quantity">
              </div>
              <div class="col-md-3 d-flex flex-column align-items-center justify-content-center">
                  <label class="fw-semibold">Assemble & Disassemble</label>
                  <div class="form-check form-switch">
                      <input type="checkbox" class="form-check-input custom-switch fs-2">
                  </div>
              </div>
              <div class="col-md-2 d-flex flex-column align-items-center justify-content-center">
                  <label class="fw-semibold">Wood Crating</label>
                  <div class="form-check form-switch">
                      <input type="checkbox" class="form-check-input custom-switch fs-2">
                  </div>
              </div>
              <div class="col-md-2 d-flex flex-column align-items-center justify-content-center">
                  <label class="fw-semibold">Wall Dismounting</label>
                  <div class="form-check form-switch">
                      <input type="checkbox" class="form-check-input custom-switch fs-2">
                  </div>
              </div>
              <div class="col-md-2 d-flex align-items-center justify-content-center">
                  <button class="btn btn-danger btn-sm remove-row">❌ Cancel</button>
              </div>
          </div>
      `);
  });

  // Remove Row Using Event Delegation
  $("#dynamicRowsContainer").on("click", ".remove-row", function () {
    $(this).closest(".dynamic-row").remove();
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const spancoStatus = document.getElementById("spancoStatus");
  const lastRemark = document.getElementById("lastRemark");

  // Define remark options for each SPANCO status
  const remarkOptions = {
    suspect: [
      "Initial contact made",
      "Awaiting response",
      "Needs qualification",
      "Cold lead",
    ],
    prospect: [
      "Qualified lead",
      "Meeting scheduled",
      "Follow-up required",
      "Interested in product",
    ],
    analysis: [
      "Requirements gathered",
      "Solution proposed",
      "Budget discussion",
      "Technical evaluation",
    ],
    negotiation: [
      "Price negotiation",
      "Contract terms discussion",
      "Competitor comparison",
      "Final proposal sent",
    ],
    closure: [
      "Deal agreed",
      "Contract signed",
      "Awaiting payment",
      "Final approval pending",
    ],
    order: [
      "Order confirmed",
      "Payment received",
      "Delivery scheduled",
      "Post-sale follow-up",
    ],
    lost: [
      "Lost to competitor",
      "Budget constraints",
      "No response",
      "Not a fit",
    ],
    "not eligible": [
      "Out of target market",
      "No budget",
      "Wrong contact",
      "Disqualified",
    ],
  };

  // Function to update lastRemark options based on spancoStatus
  function updateLastRemarkOptions() {
    const selectedStatus = spancoStatus.value;
    const options = remarkOptions[selectedStatus] || [];

    // Clear existing options
    lastRemark.innerHTML = "";

    // Add new options
    options.forEach((option) => {
      const optionElement = document.createElement("option");
      optionElement.value = option.toLowerCase().replace(/\s+/g, "_");
      optionElement.textContent = option;
      lastRemark.appendChild(optionElement);
    });

    // Optionally, add a default "Select remark" option
    const defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.textContent = "Select remark";
    defaultOption.selected = true;
    lastRemark.insertBefore(defaultOption, lastRemark.firstChild);
  }

  // Initialize lastRemark options on page load
  updateLastRemarkOptions();

  // Update lastRemark options when spancoStatus changes
  spancoStatus.addEventListener("change", updateLastRemarkOptions);
});


