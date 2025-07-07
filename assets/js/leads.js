// Function to format the date
function formatDate(dateStr) {
  if (!dateStr) return "";
  const date = new Date(dateStr);
  const day = String(date.getDate()).padStart(2, "0");
  const month = date.toLocaleString("default", { month: "long" });
  const year = date.getFullYear();
  return `${day} ${month} ${year}`;
}

var sortState = {
  key: null,
  direction: "asc",
};

// Sort leads
function sortLeads(leads) {
  if (!sortState.key) return leads;

  const SPANCO_ORDER_ASC = ["S", "P", "A", "N", "C", "O", "L"];
  const SPANCO_ORDER_DESC = [...SPANCO_ORDER_ASC].reverse();

  return leads.sort(function (a, b) {
    const fieldMap = {
      leadId: "id",
      leadDate: "created_at",
      customerName: "customer_name",
      contactNo: "customer_mobile",
      // spanco: "spanco",
      // moveDate: "moving_date",
      // leadManager: "manager_id",
      cityName: "city",
    };

    const field = fieldMap[sortState.key];

    if (sortState.key === "spanco") {
      const valueA = (a[field] || "").charAt(0).toUpperCase();
      const valueB = (b[field] || "").charAt(0).toUpperCase();

      const order =
        sortState.direction === "asc" ? SPANCO_ORDER_ASC : SPANCO_ORDER_DESC;
      const indexA = order.indexOf(valueA);
      const indexB = order.indexOf(valueB);

      if (indexA !== -1 && indexB !== -1) return indexA - indexB;
      if (indexA !== -1) return -1;
      if (indexB !== -1) return 1;
      return valueA.localeCompare(valueB);
    }

    let valueA = a[field];
    let valueB = b[field];

    if (sortState.key === "leadDate" || sortState.key === "moveDate") {
      valueA = new Date(valueA);
      valueB = new Date(valueB);
    } else if (sortState.key === "leadId") {
      valueA = parseInt(valueA);
      valueB = parseInt(valueB);
    } else {
      valueA = (valueA || "").toString().toUpperCase();
      valueB = (valueB || "").toString().toUpperCase();
    }

    if (valueA < valueB) return sortState.direction === "asc" ? -1 : 1;
    if (valueA > valueB) return sortState.direction === "asc" ? 1 : -1;
    return 0;
  });
}

$(document).ready(function () {
  var currentPage = 1;

  function fetchLeads(page) {
    $.ajax({
      url: base_url + "fetchLeads/" + page,
      type: "GET",
      dataType: "json",
      success: function (response) {
        var tableBody = $("#dataBody");
        tableBody.empty();

        if (response.leads.length === 0) {
          tableBody.append('<tr><td colspan="13">No leads available</td></tr>');
          return;
        }

        var sortedLeads = sortLeads(response.leads);

        $.each(sortedLeads, function (index, lead) {
          var row =
            "<tr>" +
            "<td>" +
            (index + 1) +
            "</td>" +
            "<td>" +
            '<div class="col-sm-6 col-md-4 col-lg-3">' +
            '<i class="fa fa-hand-o-up fa-2x ele-color action-icon c-p" ' +
            'data-id="' +
            (lead.id || "") +
            '" ' +
            'data-bs-toggle="modal" data-bs-target="#actionModal">' +
            "</i>" +
            "</div>" +
            "</td>" +
            "<td>" +
            (lead.id || "") +
            "</td>" +
            "<td>" +
            formatDate(lead.created_at) +
            "</td>" +
            "<td>" +
            (lead.customer_name
              ? lead.customer_name.charAt(0).toUpperCase() +
                lead.customer_name.slice(1)
              : "") +
            "</td>" +
            "<td>" +
            (lead.customer_mobile || "") +
            "</td>" +
            "<td>" +
            (lead.cubic_feet || "-") +
            "</td>" +
            "<td>" +
            (lead.moving_to || "") +
            "</td>" +
            "<td>" +
            (lead.service_type || "") +
            "</td>" +
            "</tr>";

          tableBody.append(row);
        });

        generatePagination(response.totalPages, currentPage);
      },
      error: function () {
        alert("Error fetching leads.");
      },
    });
  }

  function generatePagination(totalPages, currentPage) {
    var pagination = $("#pagination");
    pagination.empty();

    var maxVisible = 5;
    var startPage = Math.max(1, currentPage - Math.floor(maxVisible / 2));
    var endPage = startPage + maxVisible - 1;

    if (endPage > totalPages) {
      endPage = totalPages;
      startPage = Math.max(1, endPage - maxVisible + 1);
    }

    if (currentPage > 1) {
      pagination.append(
        '<li class="page-item"><a class="page-link" href="javascript:void(0);" data-page="' +
          (currentPage - 1) +
          '">Previous</a></li>'
      );
    }

    for (var i = startPage; i <= endPage; i++) {
      var activeClass = i === currentPage ? "active" : "";
      pagination.append(
        '<li class="page-item ' +
          activeClass +
          '"><a class="page-link" href="javascript:void(0);" data-page="' +
          i +
          '">' +
          i +
          "</a></li>"
      );
    }

    if (currentPage < totalPages) {
      pagination.append(
        '<li class="page-item"><a class="page-link" href="javascript:void(0);" data-page="' +
          (currentPage + 1) +
          '">Next</a></li>'
      );
    }
  }

  $(document).on("click", ".fa-sort, .fa-sort-asc, .fa-sort-desc", function () {
    const sortKey = $(this).data("key");

    if (sortState.key === sortKey) {
      sortState.direction = sortState.direction === "asc" ? "desc" : "asc";
    } else {
      sortState.key = sortKey;
      sortState.direction = "asc";
    }

    $(".fa-sort").removeClass("fa-sort-asc fa-sort-desc").addClass("fa-sort");

    $(this)
      .removeClass("fa-sort fa-sort-asc fa-sort-desc")
      .addClass(sortState.direction === "asc" ? "fa-sort-asc" : "fa-sort-desc");

    fetchLeads(currentPage);
  });

  $(document).on("click", ".page-link", function () {
    var page = $(this).data("page");
    if (page !== undefined) {
      currentPage = page;
      fetchLeads(currentPage);
    }
  });

  fetchLeads(currentPage);
});

// Modal details load
$(document).on("click", ".action-icon", function () {
  var leadId = $(this).data("id");

  $.ajax({
    url: base_url + "getLeadDetails/" + leadId,
    type: "GET",
    dataType: "json",
    success: function (response) {
      if (response.success) {
        var lead = response.data;
        console.log(lead);

        $("#modalLeadId").val(lead.id);
        $("#modalCustName").val(lead.customer_name);
        $("#modalCustMobile").val(lead.customer_mobile);
        $("#modalEmail").val(lead.customer_email);
        $("#modalCity").val(lead.city);
        $("#modalMovingDate").val(lead.moving_date);
        // Add more fields here if needed

        $("#actionModal").modal("show");
      } else {
        alert("Lead not found.");
      }
    },
    error: function () {
      alert("Something went wrong.");
    },
  });
});
