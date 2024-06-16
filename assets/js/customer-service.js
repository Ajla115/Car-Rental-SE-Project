//inside of this JSON object, we will put methods for ADD,
//DELETE, EDIT, showconfirmationDialog and etc
var CustomerService = {
  emailValidator: function () {
    jQuery.validator.addMethod(
      "customEmail",
      function (value, element) {
        // First check: General email format
        var isValidEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
        if (!isValidEmail) {
          return false;
        }

        // Second check: Admin email format
        if (/^.+@admin\.gmail\.com$/i.test(value)) {
          return false; // Invalid if email is in the admin format
        }

        return true;
      },
      function (params, element) {
        // Custom message based on the invalid condition
        if (/^.+@admin\.gmail\.com$/i.test(element.value)) {
          return "Only an admin can register other admins. You can't register yourself with this email.";
        }
        return "E-mail address is not in the right format.";
      }
    );
  },

  nameValidator: function () {
    jQuery.validator.addMethod(
      "lettersAndDash",
      function (value, element) {
        return this.optional(element) || /^[a-zA-Z-]+$/i.test(value);
      },
      "Only letters and dashes are allowed."
    );
  },

  formToJson: function (form) {
    var array = $(form).serializeArray(); //jQuery method
    //each object has two properties: name and value
    var json = {}; //javascript object

    $.each(array, function () {
      json[this.name] = this.value || "";
    });

    return json;
  },

  validateForm: function () {
    var self = this; // this is a reference to the the current object of this validateMethod, context of this changes with different callbacks
    $("#addCustomerForm").validate({
      focusCleanup: true, //element with error, hides error when gets focus
      errorElement: "em", // type of HTML element that should wrap the error message.

      rules: {
        //Define rules for form validation.
        customer_name: {
          required: true,
          lettersAndDash: true,
        },
        customer_surname: {
          required: true,
          lettersAndDash: true,
        },
        email: {
          required : true,
          customEmail : true
        },
        password: {
          required: true,
          minlength: 8,
          maxlength: 15,
        },
      },
      messages: {
        //custom error messages
        customer_name: {
          required: "First name field is empty.",
          lettersAndDash: "Only letters and dashes (-) are allowed in the first name." 
        },
        customer_surname: {
          required: "Last name field is empty.",
          lettersAndDash: "Only letters and dashes (-) are allowed in the last name." 
        },
        email:{
          required:"Email field is empty.",
          customEmail: "E-mail address is not in the appropriate format."
        },

        password: {
          required: "Password field is empty.",
          minlength:
            "Password is too short. Password must be at least 8 characters long.",
          maxlength: "Password can't be longer than 15 characters.",
        },
      },
      highlight: function (element, errorClass) {
        $(element).fadeOut(function () {
          $(element).fadeIn();
        });
      },

      errorContainer: "#messageBox1",
      errorLabelContainer: "#messageBox1 ul",
      wrapper: "li",

      submitHandler: function (form, validator) {
        const data = self.formToJson(form); // this self is refering to this JS object

        //console.log("test", typeof data);

        $.post(" ../rest/customer", data)
          .done(function (response) {
            //const token = response.token;
            const customer = response.customer;
            // Storing the JWT token in localStorage
            //localStorage.setItem("user_token", token);
            toastr.success("User added to the database");
            form.reset();

            setTimeout(function () {
              /*window.location.href = '../index2.html'*/ window.location.replace(
                "login.html"
              );
            }, 5000); // Redirect after 5 seconds to index2.html
          })
          .fail(function () {
            toastr.error("User not added");
          });
      },

      invalidHandler: function (event, validator) {
        var errors = validator.numberOfInvalids();
        toastr.error("Error");
        if (errors) {
          var message =
            errors == 1
              ? "You missed 1 field."
              : "You missed " + errors + " fields.";
          $("div.error span").html(message);
          $("div.error").show();
        } else {
          $("div.error").hide();
        }
      },
    });
  },

  init: function () {
    this.emailValidator();
    this.nameValidator();
    this.validateForm();
  },

  checkToken: function () {
    var token = localStorage.getItem("user_token");
    if (token) {
    } else {
      window.location.replace("views/index.html");
    }
  },

  getComments: function () {
    $.ajax({
      url: "rest/tests",
      type: "GET",
      beforeSend: function (xhr) {
        xhr.setRequestHeader(
          "Authorization",
          localStorage.getItem("user_token")
        );
      },
      dataType: "json",
      success: function (data) {
        console.log(data);
        for (var i = 0; i < data.length; i++) {
          var fullname = data[i].first_name + " " + data[i].last_name;
          $("#comments-swiper").append(
            '<div class="swiper-slide">' +
              '<p style="color: white; text-align: center;"><strong>' +
              fullname +
              "</strong></p>" +
              '<p style="color: white; text-align: center;"><i class="bx bxs-quote-alt-left quote-icon-left"></i>' +
              data[i].comment +
              '<i class="bx bxs-quote-alt-right quote-icon-right"></i></p>' +
              "</div>"
          );
        }

        var swiper = new Swiper(".testimonials-slider", {
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
        });
      },
      error: function (error) {
        console.error("Error:", error);
      },
    });
  },
};