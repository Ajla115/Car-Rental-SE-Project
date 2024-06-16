$(document).ready(function() {
    fetchAdmins();
});

function fetchAdmins() {
    $.ajax({
        url: "../rest/admins",
        type: "GET",
        beforeSend: function(xhr) {
            xhr.setRequestHeader(
                "Authorization",
                 localStorage.getItem("user_token") // Assuming JWT is stored in localStorage
            );
        },
        success: function(data) {
            var token = localStorage.getItem("user_token");
            var payload = JSON.parse(atob(token.split(".")[1]));
      
            let userEmail  = payload.email;
            //console.log(userEmail);
            //console.log(data);
            const adminTable = $('#adminTable');
            adminTable.empty();
            data.forEach(function(customer) {
                const row = $('<tr>');
                let actions;
                if (customer.email === 'supremeadmin@admin.gmail.com') {
                    actions = `<td>You cannot delete the default admin!</td>`;
                } else if(customer.email === userEmail){
                    actions = `<td>You cannot delete yourself!</td>`;
                }
                else {
                    actions = `<td><button class="btn-custom" onclick="deleteCustomer(${customer.id})">Delete</button></td>`;
                }
                row.html(`
                    <td>${customer.id}</td>
                    <td>${customer.customer_name}</td>
                    <td>${customer.customer_surname}</td>
                    <td>${customer.email}</td>
                    ${actions}
                `);
                adminTable.append(row);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching admins:', textStatus, errorThrown);
        }
    });
}

function deleteCustomer(id) {
    if (confirm('Are you sure you want to delete this admin?')) {
        $.ajax({
            url: `../rest/customers/${id}`, // Use backticks for template literals
            type: "DELETE",
            beforeSend: function(xhr) {
                xhr.setRequestHeader(
                    "Authorization",
                     localStorage.getItem("user_token") // Assuming JWT is stored in localStorage
                );
            },
            success: function(data) {
                alert(data.message);
                fetchAdmins();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Admin can't be deleted: Internal Server Error.");
                console.error('Error deleting admin:', textStatus, errorThrown);
            }
        });
    }
}
