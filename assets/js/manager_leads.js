document.addEventListener("DOMContentLoaded", function () {
  loadLeads(1);
});

function loadLeads(page) {
  fetch(`/manager/fetchLeads/${page}`)
    .then((res) => res.json())
    .then((data) => {
      const tbody = document.getElementById("managerLeadsBody");
      tbody.innerHTML = "";

      if (data.leads && data.leads.length > 0) {
        data.leads.forEach((lead, index) => {
          const row = `<tr>
              <td>${index + 1}</td>
              <td>${lead.id}</td>
              <td>${lead.moving_date || ""}</td>
              <td>${lead.customer_name}</td>
              <td>${lead.moving_to}</td>
              <td>${lead.city}</td>
              <td>${lead.service_type}</td>
            </tr>`;
          tbody.innerHTML += row;
        });
      } else {
        tbody.innerHTML = `<tr><td colspan="7" class="text-center">No leads found.</td></tr>`;
      }

      // Optional: handle pagination if needed
    })
    .catch((err) => {
      console.error("Error fetching leads:", err);
    });
}
