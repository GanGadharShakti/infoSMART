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
    const globalSearch = $("#globalSearch").val();
    const fromDate = $("#fromDate").val();
    const toDate = $("#toDate").val();
    const sortBy = $("#sortBy").val();

    $.ajax({
      url: base_url + "lead/fetchLeads/" + page,
      type: "GET",
      data: {
        globalSearch,
        fromDate,
        toDate,
        sortBy,
      },
      success: function (response) {
        const leads = response.data;
        const totalPages = response.totalPages;
        $("#dataBody").empty();

        if (leads.length === 0) {
          $("#dataBody").append(
            '<tr><td colspan="9" class="text-center">No data available</td></tr>'
          );
          return;
        }

        leads.forEach((lead, index) => {
          const row = `
            <tr>
              <td>${(page - 1) * 10 + index + 1}</td>
              <td>
                <button class="btn btn-sm btn-primary action-icon" data-id="${lead.id}" title="View Inventory">
                  <i class="fas fa-eye"></i>
                </button>
              </td>
              <td>${lead.id}</td>
              <td>${formatDate(lead.created_at)}</td>
              <td>${lead.cust_wr_name}</td>
              <td>${lead.cust_wr_contact}</td>
              <td>${lead.home_size}</td>
              <td>${lead.warehouse_location || "N/A"}</td>
              <td>${lead.service_type}</td>
            </tr>`;
          $("#dataBody").append(row);
        });

        renderPagination(totalPages, page);
      },
      error: function () {
        alert("Failed to fetch data.");
      },
    });
  }

  function renderPagination(totalPages, currentPage) {
    const pagination = $("#pagination");
    pagination.empty();

    for (let i = 1; i <= totalPages; i++) {
      pagination.append(`
        <li class="page-item ${i === currentPage ? "active" : ""}">
          <a class="page-link page-num" href="#" data-page="${i}">${i}</a>
        </li>`);
    }
  }

  // Pagination click
  $(document).on("click", ".page-num", function (e) {
    e.preventDefault();
    const selectedPage = parseInt($(this).data("page"));
    if (!isNaN(selectedPage)) {
      currentPage = selectedPage;
      fetchLeads(currentPage);
    }
  });

  // Filter/search/sort
  $("#globalSearch, #fromDate, #toDate, #sortBy").on("change keyup", function () {
    currentPage = 1;
    fetchLeads(currentPage);
  });

  // Redirect to inventory view page
  $(document).on("click", ".action-icon", function () {
    const leadId = $(this).data("id");
    window.location.href = `${base_url}inventory/view/${leadId}`;
  });

  // Initial fetch
  fetchLeads(currentPage);
});
