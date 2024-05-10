var ReviewService = {
    
    showToast: function(message) {
        // Create toaster element
        var toaster = document.createElement('div');
        toaster.classList.add('toaster');
        toaster.textContent = message;

        // Append toaster to the body
        document.body.appendChild(toaster);

        // Remove toaster after 3 seconds
        setTimeout(function() {
            toaster.remove();
        }, 3000);
    },

//WORKS!!!!!!
/*
getReview: function() {
    $.ajax({
        url: './rest/tests/',
        type: 'GET',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        },
        success: function(data) {
            var tableBody = $('#reviewsTableBody');
            tableBody.empty(); // Clear existing rows

            for (var i = 0; i < data.length; i++) {
                var testimonialId = data[i].id;
                var testimonial = data[i].comment;
                var name = data[i].first_name + ' ' + data[i].last_name;

                var row = $('<tr id="review_' + testimonialId + '"></tr>');
                var nameCell = $('<td class="name"></td>').text(name);
                var testimonialCell = $('<td class="description"></td>').text(testimonial);

                // Add edit button
                var editButton = $('<button>Edit</button>').click(function() {
                    var id = $(this).closest('tr').attr('id').split('_')[1];
                    var newComment = prompt("Edit your comment:", testimonial);
                    if (newComment !== null) {
                        ReviewService.editReview(id, newComment);
                    }
                });
                var editCell = $('<td></td>').append(editButton);

                // Add delete button
                var deleteButton = $('<button>Delete</button>').click(function() {
                    var id = $(this).closest('tr').attr('id').split('_')[1];
                    var confirmDelete = confirm("Are you sure you want to delete this comment?");
                    if (confirmDelete) {
                        ReviewService.deleteReview(id);
                    }
                });
                var deleteCell = $('<td></td>').append(deleteButton);

                row.append(editCell);
                row.append(deleteCell);
                row.append(nameCell);
                row.append(testimonialCell);
                tableBody.append(row);
            }
        }
    });
},*/
//WORKS!!!
/*
getReview: function() {
    $.ajax({
        url: './rest/tests/',
        type: 'GET',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        },
        success: function(data) {
            var tableBody = $('#reviewsTableBody');
            tableBody.empty(); // Clear existing rows

            // Retrieving the JWT payload from local storage
            var token = localStorage.getItem('user_token');
            console.log("JWT Token:", token);

            var payload = JSON.parse(atob(token.split('.')[1]));
            console.log("Parsed Payload:", payload);

            var firstName = payload.customer_name;
            var lastName = payload.customer_surname;
            console.log("Retrieved first name:", firstName);
            console.log("Retrieved last name:", lastName);

            for (var i = 0; i < data.length; i++) {
                var testimonialId = data[i].id;
                var testimonial = data[i].comment;
                var name = data[i].first_name + ' ' + data[i].last_name;

                var row = $('<tr id="review_' + testimonialId + '"></tr>');
                var nameCell = $('<td class="name"></td>').text(name);
                var testimonialCell = $('<td class="description"></td>').text(testimonial);

                // Only show delete and edit buttons for reviews written by the currently logged-in user
                if (name === (firstName + ' ' + lastName)) {
                    var editButton = $('<button>Edit</button>').click(function() {
                        var id = $(this).closest('tr').attr('id').split('_')[1];
                        var newComment = prompt("Edit your comment:", testimonial);
                        if (newComment !== null) {
                            ReviewService.editReview(id, newComment);
                        }
                    });
                    var editCell = $('<td></td>').append(editButton);

                    var deleteButton = $('<button>Delete</button>').click(function() {
                        var id = $(this).closest('tr').attr('id').split('_')[1];
                        var confirmDelete = confirm("Are you sure you want to delete this comment?");
                        if (confirmDelete) {
                            ReviewService.deleteReview(id);
                        }
                    });
                    var deleteCell = $('<td></td>').append(deleteButton);

                    row.append(editCell);
                    row.append(deleteCell);
                }

                row.append(nameCell);
                row.append(testimonialCell);
                tableBody.append(row);
            }
        }
    });
},*/
//WORKS NEWEST VERSION
/*
getReview: function() {
    $.ajax({
        url: './rest/tests/',
        type: 'GET',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        },
        success: function(data) {
            var tableBody = $('#reviewsTableBody');
            tableBody.empty(); // Clear existing rows

            // Retrieving the JWT payload from local storage
            var token = localStorage.getItem('user_token');
            console.log("JWT Token:", token);

            var payload = JSON.parse(atob(token.split('.')[1]));
            console.log("Parsed Payload:", payload);

            var firstName = payload.customer_name;
            var lastName = payload.customer_surname;
            console.log("Retrieved first name:", firstName);
            console.log("Retrieved last name:", lastName);

            for (var i = 0; i < data.length; i++) {
                var testimonialId = data[i].id;
                var testimonial = data[i].comment;
                var name = data[i].first_name + ' ' + data[i].last_name;

                var row = $('<tr id="review_' + testimonialId + '"></tr>');
                var nameCell = $('<td class="name"></td>').text(name);
                var testimonialCell = $('<td class="description"></td>').text(testimonial);
                var actionsCell = $('<td class="actions"></td>');

                // Only show delete and edit buttons for reviews written by the currently logged-in user
                if (name === (firstName + ' ' + lastName)) {
                    var editButton = $('<button>Edit</button>').click(function() {
                        var id = $(this).closest('tr').attr('id').split('_')[1];
                        var newComment = prompt("Edit your comment:", testimonial);
                        if (newComment !== null) {
                            ReviewService.editReview(id, newComment);
                        }
                    });
                    var deleteButton = $('<button>Delete</button>').click(function() {
                        var id = $(this).closest('tr').attr('id').split('_')[1];
                        var confirmDelete = confirm("Are you sure you want to delete this comment?");
                        if (confirmDelete) {
                            ReviewService.deleteReview(id);
                        }
                    });

                    actionsCell.append(editButton).append(deleteButton);
                }

                row.append(nameCell).append(testimonialCell).append(actionsCell);
                tableBody.append(row);
            }
        }
    });
},*/

getReview: function() {
    $.ajax({
        url: './rest/tests/',
        type: 'GET',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        },
        success: function(data) {
            var tableBody = $('#reviewsTableBody');
            tableBody.empty(); // Clear existing rows

            // Retrieving the JWT payload from local storage
            var token = localStorage.getItem('user_token');
            console.log("JWT Token:", token);

            var payload = JSON.parse(atob(token.split('.')[1]));
            console.log("Parsed Payload:", payload);

            var firstName = payload.customer_name;
            var lastName = payload.customer_surname;
            console.log("Retrieved first name:", firstName);
            console.log("Retrieved last name:", lastName);

            for (var i = 0; i < data.length; i++) {
                var testimonialId = data[i].id;
                var testimonial = data[i].comment;
                var name = data[i].first_name + ' ' + data[i].last_name;

                var row = $('<tr id="review_' + testimonialId + '"></tr>');
                var nameCell = $('<td class="name"></td>').text(name);
                var testimonialCell = $('<td class="description"></td>').text(testimonial);
                var actionsCell = $('<td class="actions"></td>');

                // Only show delete and edit buttons for reviews written by the currently logged-in user
                if (name === (firstName + ' ' + lastName)) {
                    var editButton = $('<button style="margin-right: 5px;">Edit</button>').click(function() {
                        var id = $(this).closest('tr').attr('id').split('_')[1];
                        var newComment = prompt("Edit your comment:", testimonial);
                        if (newComment !== null) {
                            ReviewService.editReview(id, newComment);
                        }
                    });
                    var deleteButton = $('<button style="margin-left: 5px;">Delete</button>').click(function() {
                        var id = $(this).closest('tr').attr('id').split('_')[1];
                        var confirmDelete = confirm("Are you sure you want to delete this comment?");
                        if (confirmDelete) {
                            ReviewService.deleteReview(id);
                        }
                    });

                    actionsCell.append(editButton).append(deleteButton);
                }

                row.append(nameCell).append(testimonialCell).append(actionsCell);
                tableBody.append(row);
            }
        }
    });
},

 //WORKS!!!!
deleteReview: function(id) {
    $.ajax({
        url: './rest/tests/' + id,
        type: 'DELETE',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        },
        success: function(data) {
            // Remove the deleted review from the UI
            $('#review_' + id).remove();
        }
    });
},

//WORKS!!!!!!!
submitReview: function(name, surname, description) {
    $.ajax({
        url: './rest/tests',
        type: 'POST',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        },
        data: {
            first_name: name,
            last_name: surname,
            comment: description
        },
        success: function(data) {
            // Update the UI with the new review
            var testimonialText = $('<div></div>').text(description);
            var nameElement = $('<div></div>').text(name + ' ' + surname);
            $('#testemonialtextvw').append(testimonialText);
            $('#Clientnamevw').append(nameElement);
            
            // Optionally, update the table with the new review
            var row = $('<tr></tr>');
            var nameCell = $('<td class="name"></td>').text(name);
            var testimonialCell = $('<td class="description"></td>').text(description);
            row.append(nameCell);
            row.append(testimonialCell);
            $('#reviewsTableBody').append(row);

            // Reset the form
            $('#reviewForm')[0].reset();
        }
    });
},

//WORKS!!!!!!!
editReview: function(id, newComment) {
    $.ajax({
        url: './rest/tests/' + id,
        type: 'PUT',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        },
        data: JSON.stringify({
            comment: newComment
        }),
        contentType: 'application/json',
        success: function(data) {
            // Update the UI with the edited review
            $('#review_' + id + ' .description').text(newComment);
            alert("Comment edited successfully!");
        }
    });
}
    
};


// Example usage for editing a review
$('#editReviewForm').on('submit', function(e) {
    e.preventDefault();
    var id = 123; // Example ID of the review to edit
    var name = $('#editNameInput').val();
    var surname = $('#editSurnameInput').val();
    var description = $('#editDescriptionInput').val();
    CarService.editReview(id, name, surname, description);
});

$('#reviewForm').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission

    var name = $('#name').val();
    var surname = $('#surname').val();
    var description = $('#description').val();

    // Call the submitReview function with the form data
    ReviewService.submitReview(name, surname, description);
});

