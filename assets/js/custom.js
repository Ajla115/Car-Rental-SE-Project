$(document).ready(function() {
    fetchCustomers();
});

function fetchCustomers() {
    $.ajax({
        url: "../rest/customers",
        type: "GET",
        beforeSend: function(xhr) {
            xhr.setRequestHeader(
                "Authorization",
                "Bearer " + localStorage.getItem("jwt") // Assuming JWT is stored in localStorage
            );
        },
        success: function(data) {
            const customerTable = $('#customerTable');
            customerTable.empty();
            data.forEach(function(customer) {
                const row = $('<tr>');
                row.html(`
                    <td>${customer.id}</td>
                    <td>${customer.customer_name}</td>
                    <td>${customer.customer_surname}</td>
                    <td>${customer.email}</td>
                    <td><button class="btn-custom" onclick="deleteCustomer(${customer.id})">Delete</button></td>
                `);
                customerTable.append(row);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching customers:', textStatus, errorThrown);
        }
    });
}

function deleteCustomer(id) {
    if (confirm('Are you sure you want to delete this customer?')) {
        $.ajax({
            url: `../rest/customers/${id}`, // Use backticks for template literals
            type: "DELETE",
            beforeSend: function(xhr) {
                xhr.setRequestHeader(
                    "Authorization",
                    "Bearer " + localStorage.getItem("jwt") // Assuming JWT is stored in localStorage
                );
            },
            success: function(data) {
                alert(data.message);
                fetchCustomers();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error deleting customer:', textStatus, errorThrown);
            }
        });
    }
}
