var UserService = {
  init: function () {
    var token = localStorage.getItem("user_token");
    if (token) {
      window.location.replace("../index2.html");
    }

    $("#login-form").validate({
      submitHandler: function (form) {
        //console.log("data123");
        var entity = Object.fromEntries(new FormData(form).entries());
        UserService.login(entity);
      },
    });

    this.setupEditableFields();
  },

  login: function (entity) {
    $.ajax({
      url: "../rest/login",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function (response) {
        localStorage.setItem("user_token", response?.jwt);
        window.location = "../index2.html";
      },
      fail: function (XMLHttpRequest, textStatus, errorThrown) {
        alert(XMLHttpRequest.responseJSON?.message);
        console.log("Test");
        console.log("Error: ", XMLHttpRequest.responseJSON, textStatus, errorThrown); // Add this for debugging
        toastr.error(
          XMLHttpRequest.responseJSON?.message || "An error occurred during login"
        );
        // toastr.error(XMLHttpRequest.responseJSON.message);
      },
    });
  },

  logout: function () {
    localStorage.clear();
    window.location.replace("views/index.html");
  },

  getUserInformation: function () {
    var token = localStorage.getItem("user_token");
    var payload = JSON.parse(atob(token.split(".")[1]));

    document.getElementById("customerID").innerText = "ID: " + payload.id;
    document.getElementById("fullnameDiv").innerText =
      payload.customer_name + " " + payload.customer_surname;
    document.getElementById("firstnameDiv").innerText = payload.customer_name;
    document.getElementById("lastnameDiv").innerText = payload.customer_surname;
    document.getElementById("emailDiv").innerText = payload.email;
  },

  setupEditableFields: function () {
    $("#editButton").click(function () {
      UserService.editAllFields();
    });
    $("#saveButton").click(function () {
      UserService.saveAllFields();
    });
    $("#cancelButton").click(function () {
      UserService.cancelAllEdits();
    });
  },

  editAllFields: function () {
    ["firstname", "lastname", "email"].forEach((field) => {
      $("#" + field + "Div").hide();
      $("#" + field + "Input")
        .val($("#" + field + "Div").text())
        .show();
    });
    $("#editButton").hide();
    $("#saveButton, #cancelButton").show();
  },

  saveAllFields: function () {
    var customerIDWithPrefix = $("#customerID").text(); // This will get something like "ID: 12345"
    var customerID = customerIDWithPrefix.replace("ID: ", "").trim();

    if (!customerID) {
      alert("Customer ID is missing or invalid!");
      return; // Stop execution if no valid ID is found
    }

    var isValid = true; // Flag to check if all data is valid
    var fields = {
      firstname: $("#firstnameInput").val().trim(),
      lastname: $("#lastnameInput").val().trim(),
      email: $("#emailInput").val().trim(),
    };

    // Email validation regex
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailRegex.test(fields.email)) {
      alert("Please enter a valid email address.");
      isValid = false; // Indicate invalid input
    }

    // Name validation regex (for both first and last names)
    var nameRegex = /^[a-zA-Z-]+$/;
    if (!nameRegex.test(fields.firstname) || !nameRegex.test(fields.lastname)) {
      alert("Names can only contain letters and dashes.");
      isValid = false; // Indicate invalid input
    }

    if (isValid) {
      // Update the UI
      ["firstname", "lastname", "email"].forEach(function (field) {
        $("#" + field + "Div")
          .text(fields[field])
          .show();
        $("#" + field + "Input").hide();
      });
      $("#editButton").show();
      $("#saveButton, #cancelButton").hide();

      // Make the AJAX request to update the customer
      $.ajax({
        url: "rest/updatesinglecustomer",
        type: "PUT",
        beforeSend: function (xhr) {
          xhr.setRequestHeader(
            "Authorization",
            localStorage.getItem("user_token")
          );
        },
        data: JSON.stringify({
          id: customerID,
          customer_name: fields.firstname,
          customer_surname: fields.lastname,
          email: fields.email,
        }),
        contentType: "application/json; charset=utf-8",
        success: function (response) {
          alert("Successful update. Redirecting...");
          console.log("Update successful", response);
          localStorage.clear(); // Clearing local storage (be careful with this operation)
          window.location.replace("views/login.html");
        },
        error: function () {
          alert("Error updating customer.");
        },
      });
    }
  },

  cancelAllEdits: function () {
    ["firstname", "lastname", "email"].forEach((field) => {
      $("#" + field + "Input").hide();
      $("#" + field + "Div").show();
    });
    $("#editButton").show();
    $("#saveButton, #cancelButton").hide();
  },
};

