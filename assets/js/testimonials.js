var ReviewService = {
    getReview: function() {
      $.ajax({
        url: '../rest/tests',
        type: 'GET',
        beforeSend: function(xhr) {
          xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        },
        success: function(data) {
          var tableBody = $('#reviewsTableBody');
          tableBody.empty();
          var token = localStorage.getItem('user_token');
          var payload = JSON.parse(atob(token.split('.')[1]));
          var firstName = payload.customer_name;
          var lastName = payload.customer_surname;
          var email = payload.email || ""; // Default to empty string if email is undefined
  
          data.forEach(function(item) {
            var row = $('<tr id="review_' + item.id + '"></tr>');
            var name = item.first_name + ' ' + item.last_name;
            var testimonialCell = $('<td class="description"></td>').text(item.comment);
            var nameCell = $('<td class="name"></td>').text(name);
            var actionsCell = $('<td class="actions"></td>');
  
            if (name === (firstName + ' ' + lastName) || email.endsWith('@admin.gmail.com')) {
              if (name === (firstName + ' ' + lastName)) {
                var editButton = $('<button class="btn btn-warning btn-sm mr-2">Edit</button>').click(function() {
                  var id = $(this).closest('tr').attr('id').split('_')[1];
                  var newComment = prompt("Edit your comment:", item.comment);
                  if (newComment !== null) {
                    ReviewService.editReview(id, newComment);
                  }
                });
                actionsCell.append(editButton);
              }
  
              var deleteButton = $('<button class="btn btn-danger btn-sm">Delete</button>').click(function() {
                var id = $(this).closest('tr').attr('id').split('_')[1];
                var confirmDelete = confirm("Are you sure you want to delete this comment?");
                if (confirmDelete) {
                  ReviewService.deleteReview(id);
                }
              });
  
              actionsCell.append(deleteButton);
            }
  
            row.append(nameCell).append(testimonialCell).append(actionsCell);
            tableBody.append(row);
          });
        }
      });
    },
  
    deleteReview: function(id) {
      $.ajax({
        url: '../rest/tests/' + id,
        type: 'DELETE',
        beforeSend: function(xhr) {
          xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        },
        success: function(data) {
          $('#review_' + id).remove();
        },
        error: function(xhr) {
          if (xhr.status === 403) {
            alert("You are not authorized to delete this comment.");
          }
        }
      });
    },
  
    editReview: function(id, newComment) {
      $.ajax({
        url: '../rest/tests/' + id,
        type: 'PUT',
        beforeSend: function(xhr) {
          xhr.setRequestHeader("Authorization", localStorage.getItem("user_token"));
        },
        data: JSON.stringify({
          comment: newComment
        }),
        contentType: 'application/json',
        success: function(data) {
          $('#review_' + id + ' .description').text(newComment);
          alert("Comment edited successfully!");
        },
        error: function(xhr) {
          if (xhr.status === 403) {
            alert("You are not authorized to edit this comment.");
          }
        }
      });
    },
  
    submitReview: function(name, surname, description) {
      $.ajax({
        url: '../rest/tests',
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
          var testimonialText = $('<div></div>').text(description);
          var nameElement = $('<div></div>').text(name + ' ' + surname);
          $('#testemonialtextvw').append(testimonialText);
          $('#Clientnamevw').append(nameElement);
  
          var row = $('<tr></tr>');
          var nameCell = $('<td class="name"></td>').text(name);
          var testimonialCell = $('<td class="description"></td>').text(description);
          row.append(nameCell);
          row.append(testimonialCell);
          $('#reviewsTableBody').append(row);
  
          $('#reviewForm')[0].reset();
          // Show toaster notification
          alert("Review added successfully!");
        }
      });
    }
  };
  
  $(document).ready(function() {
    ReviewService.getReview();
    $('#reviewForm').submit(function(event) {
      event.preventDefault();
      var name = $('#name').val();
      var surname = $('#surname').val();
      var description = $('#description').val();
      ReviewService.submitReview(name, surname, description);
    });
  });
  