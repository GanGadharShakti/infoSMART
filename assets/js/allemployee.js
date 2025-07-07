// $(document).ready(function () {
//   fetchUsers();

//   function fetchUsers() {
//     $.ajax({
//       url: BASE_URL + "employee",
//       type: "GET",
//       dataType: "json",
//       success: function (response) {
//         if (response.status === "success") {
//           const tbody = $("#userTableBody");
//           tbody.empty();

//           $.each(response.data, function (index, user) {
//             const row = `
//                 <tr>
//                   <td>${index + 1}</td>
//                   <td>${user.name}</td>
//                   <td>${user.email}</td>
//                   <td>${user.phone_number}</td>
//                   <td>${user.assign_location || "-"}</td>
//                   <td>${user.user_role}</td>
//                   <td>${user.status}</td>
//                   <td>${user.created_at}</td>
//                   <td>${user.updated_at}</td>
//                   <td>
//                     <button class="btn btn-sm btn-primary edit-btn" data-id="${
//                       user.user_id
//                     }">Edit</button>
//                   </td>
//                 </tr>
//               `;
//             tbody.append(row);
//           });
//         } else {
//           alert("No users found.");
//         }
//       },
//       error: function () {
//         alert("Error fetching user data.");
//       },
//     });
//   }
// });
