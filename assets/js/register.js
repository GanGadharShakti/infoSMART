// From Registration

$("#registerForm").submit(function (e) {
  e.preventDefault();
  var form = $(this);
  var formData = form.serialize();

  // Clear previous error messages
  $(".text-danger").html("");

  $.ajax({
    // url: "<?= base_url('register/save') ?>",
    url: BASE_URL + "register/save",

    method: "POST",
    data: formData,
    dataType: "json",
    success: function (response) {
      if (response.status === "success") {
        $("#successMessage")
          .removeClass("d-none alert-danger")
          .addClass("alert alert-success")
          .html(response.message);
        $("#registerForm")[0].reset();
      } else if (response.status === "error") {
        $.each(response.errors, function (key, val) {
          $(".error-" + key).html(val);
        });
      }
    },
    error: function () {
      alert("Something went wrong. Please try again.");
    },
  });
});

// From Registration  Close

//warehose fetching

$(document).ready(function () {
  $.ajax({
    url: BASE_URL + "warehouses",
    method: "GET",
    dataType: "json",
    success: function (data) {
      const $warehouseSelect = $('select[name="warehouse_id"]');
      //   const $warehouseSelect = $('select[name="assign_location"]');

      $warehouseSelect
        .empty()
        .append('<option value="">Select Warehouse</option>');

      data.forEach(function (item) {
        $warehouseSelect.append(
          `<option value="${item.warehouse_id}">${item.state} - ${item.city}</option>`
        );
      });
    },
    error: function () {
      alert("Failed to load warehouse list.");
    },
  });
});

// $("#registerForm").submit(function (e) {
//   e.preventDefault();
//   $(".text-danger").text(""); // Clear errors
//   $("#successMessage")
//     .addClass("d-none")
//     .removeClass("alert-success alert-danger")
//     .text("");

//   $.ajax({
//     url: "<?= base_url('Home/save') ?>",
//     type: "POST",
//     data: $(this).serialize(),
//     dataType: "json",
//     success: function (response) {
//       if (response.status === "success") {
//         $("#successMessage")
//           .removeClass("d-none")
//           .addClass("alert alert-success")
//           .text(response.message);
//         $("#registerForm")[0].reset();
//       } else if (response.status === "error") {
//         $.each(response.errors, function (key, value) {
//           $(".error-" + key).text(value);
//         });
//       }
//     },
//     error: function () {
//       $("#successMessage")
//         .removeClass("d-none")
//         .addClass("alert alert-danger")
//         .text("An error occurred. Please try again.");
//     },
//   });
// });

// WareHouse Fetcing close







// edite

let selectedUserId;

// Store the user ID when action icon is clicked
$(document).on("click", ".user-action-icon", function () {
  selectedUserId = $(this).data("id");
});

// Edit Button - redirects to edit page
$("#editUserBtn").click(function () {
  if (selectedUserId) {
    window.location.href;
    url: BASE_URL + "allemployee/edit", +selectedUserId;
  }
});

// View Button - for now, reuse edit page
$("#viewUserBtn").click(function () {
  if (selectedUserId) {
    window.location.href 
       url: BASE_URL +"allemployee/edit", + selectedUserId
      // "<?= base_url('allemployee/edit/') ?>";
  }
});

// Delete Button - confirm and send POST request
$("#deleteUserBtn").click(function () {
  if (selectedUserId && confirm("Are you sure you want to delete this user?")) {
    $.ajax({
      url: BASE_URL + "allemployee/delete",
      method: "POST",
      data: {
        id: selectedUserId,
      },
      success: function (response) {
        if (response.success) {
          alert("User deleted successfully.");
          location.reload();
        } else {
          alert("Failed to delete user.");
        }
      },
      error: function () {
        alert("Something went wrong. Try again.");
      },
    });
  }
});
