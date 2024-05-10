var UserService = {
    init: function () {
      
      var token = localStorage.getItem("user_token"); //if we want to set a value, rather than retireve it then write setItem("user_token", value);
      if (token) {                                    //if token exists, then redirect to index2.html page
        window.location.replace("../index2.html");
      }

      $("#login-form").validate({
        
        submitHandler: function (form) {
          //console.log("data123");
          var entity = Object.fromEntries(new FormData(form).entries());
          UserService.login(entity);
        },
      });
    },

    login: function (entity) {
      $.ajax({
        url: "../rest/login",
        type: "POST",
         beforeSend: function (xhr) {
          xhr.setRequestHeader(
            "Authorization",
            localStorage.getItem("user_token")
          );
        },
        data: JSON.stringify(entity),
        contentType: "application/json",
        dataType: "json",
        success: function (result) {
          console.log(result);
          localStorage.setItem("user_token", result.token); //this "user_token" is how we have named our token
          window.location.replace("../index2.html");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          toastr.error(XMLHttpRequest.responseJSON.message);
        },
      });
    },
  
    logout: function () {   //this is a logout function
      localStorage.clear();
      window.location.replace("views/index.html");
    },

    getUserInformation: function(){
    // Retrieving the JWT payload from local storage
    var token = localStorage.getItem('user_token');
    
    // Parsing the JWT payload to get the first_name and last_name and email values
    var payload = JSON.parse(atob(token.split('.')[1]));
    //1 is payload and that will become JSON object
    
    // Getting the first_name, last_name and email values
    var firstName = payload.customer_name;
    var lastName = payload.customer_surname;
    var email = payload.email;
    

    
    // Setting the content of the divs of the user.html
    document.getElementById("fullnameDiv").innerText = firstName + " " + lastName;
    document.getElementById("firstnameDiv").innerText = firstName;
    document.getElementById("lastnameDiv").innerText = lastName;
    document.getElementById("emailDiv").innerText =  email;
    

    }
  };

  //for logout, you will need to put button with onclick = UserService.logout()


