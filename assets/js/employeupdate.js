let selectedUserId = null;

// Handle action icon click and store selected user ID
document.querySelectorAll('.user-action-icon').forEach(icon => {
    icon.addEventListener('click', function () {
        selectedUserId = this.getAttribute('data-id');
    });
});

// Edit Button Click
document.getElementById('editUserBtn').addEventListener('click', function () {
    if (selectedUserId) {
        window.location.href = base_url + 'allemployee/edit/' + selectedUserId;
    }
});

// Delete Button Click
document.getElementById('deleteUserBtn').addEventListener('click', function () {
    if (selectedUserId && confirm("Are you sure you want to delete this user?")) {
        fetch(base_url + 'allemployee/delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new URLSearchParams({ id: selectedUserId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('User deleted successfully');
                window.location.reload();
            } else {
                alert('Failed to delete user');
            }
        });
    }
});

// View Button Click (optional - shows alert)
document.getElementById('viewUserBtn').addEventListener('click', function () {
    if (selectedUserId) {
        alert("View user details for ID: " + selectedUserId);
    }
});
