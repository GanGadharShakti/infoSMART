$(document).ready(function () {
  let currentPage = 1;

  function formatDate(dateStr) {
    if (!dateStr) return "";
    const date = new Date(dateStr);
    const day = String(date.getDate()).padStart(2, "0");
    const month = date.toLocaleString("default", { month: "long" });
    const year = date.getFullYear();
    return `${day} ${month} ${year}`;
  }

  function fetchLeads(page = 1) {
    const filters = {
      globalSearch: $("#globalSearch").val(),
      sortBy: $("#sortBy").val(),
      fromDate: $("#fromDate").val(),
      toDate: $("#toDate").val(),
      showEntries: $("#showEntries").val(),
      tableSearch: $("#tableSearch").val(),
    };

    $.ajax({
      url: `${base_url}fetchLeads/${page}`,
      method: "GET",
      data: filters,
      dataType: "json",
      success: function (response) {
        const tbody = $("#dataBody");
        tbody.empty();

        if (!response.leads || response.leads.length === 0) {
          tbody.append('<tr><td colspan="9">No leads available</td></tr>');
          $("#totalLeadsCardValue").text(0);
          return;
        }

        $.each(response.leads, function (index, lead) {
          const row = `
            <tr>
              <td>${index + 1}</td>
              <td>
                <div class="col-sm-6 col-md-4 col-lg-3">
                  <i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p"
                     data-id="${lead.id}"
                     data-bs-toggle="modal"
                     data-bs-target="#actionModal"></i>
                </div>
              </td>
              <td>${lead.id}</td>
              <td>${formatDate(lead.created_at)}</td>
              <td>${
                lead.customer_name
                  ? lead.customer_name.charAt(0).toUpperCase() +
                    lead.customer_name.slice(1)
                  : ""
              }</td>
              <td>${lead.customer_mobile || ""}</td>
              <td>${lead.cubic_feet || "-"}</td>
              <td>${lead.moving_to || ""}</td>
              <td>${lead.service_type || ""}</td>
            </tr>
          `;
          tbody.append(row);
        });

        generatePagination(response.totalPages, page);

        // Update total leads card count
        if (response.totalLeads !== undefined) {
          $("#totalLeadsCardValue").text(response.totalLeads);
        }
      },
      error: function () {
        alert("Error fetching leads.");
      },
    });
  }

  function generatePagination(totalPages, currentPage) {
    const pagination = $("#pagination");
    pagination.empty();

    const maxVisible = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
    let endPage = startPage + maxVisible - 1;

    if (endPage > totalPages) {
      endPage = totalPages;
      startPage = Math.max(1, endPage - maxVisible + 1);
    }

    if (currentPage > 1) {
      pagination.append(
        `<li class="page-item"><a class="page-link" href="javascript:void(0);" data-page="${
          currentPage - 1
        }">Previous</a></li>`
      );
    }

    for (let i = startPage; i <= endPage; i++) {
      const active = i === currentPage ? "active" : "";
      pagination.append(
        `<li class="page-item ${active}"><a class="page-link" href="javascript:void(0);" data-page="${i}">${i}</a></li>`
      );
    }

    if (currentPage < totalPages) {
      pagination.append(
        `<li class="page-item"><a class="page-link" href="javascript:void(0);" data-page="${
          currentPage + 1
        }">Next</a></li>`
      );
    }
  }

  // Filter/trigger handlers
  $(
    "#search-button, #globalSearch, #sortBy, #fromDate, #toDate, #showEntries, #tableSearch"
  ).on("input change", function () {
    currentPage = 1;
    fetchLeads(currentPage);
  });

  $(document).on("click", ".page-link", function () {
    const page = $(this).data("page");
    if (page) {
      currentPage = page;
      fetchLeads(currentPage);
    }
  });

  // Initial load
  fetchLeads(currentPage);
});

// ===================

// When action icon is clicked
$(document).on("click", ".action-icon", function () {
  const leadId = $(this).data("id");
  // const leadId = $(this).data("id");
  console.log("Clicked Lead ID:", leadId);
  $("#customerDetails").html("Loading...");

  $.ajax({
    url: `${base_url}leads/customer/${leadId}`,
    type: "GET",
    dataType: "json",
    success: function (response) {
      if (response.status === "success") {
        const c = response.customer;
        const content = `
          <p><strong>Name:</strong> ${c.name}</p>
          <p><strong>Email:</strong> ${c.email}</p>
          <p><strong>Phone:</strong> ${c.phone}</p>
          <p><strong>Address:</strong> ${c.address || "-"}</p>
          <p><strong>City:</strong> ${c.city || "-"}</p>
        `;
        $("#customerDetails").html(content);
      } else {
        $("#customerDetails").html("Customer not found.");
      }
    },
    error: function () {
      $("#customerDetails").html("Error fetching customer.");
    }
  });
});
$(document).on("click", ".action-icon", function () {
  const leadId = $(this).data("id");
  console.log("Redirecting with Lead ID:", leadId);

  // Redirect to inventory viewing page with the lead ID
  window.location.href = `${base_url}inventory/view/${leadId}`;
});
