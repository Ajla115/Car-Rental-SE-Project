 var RestClient = {
        get: function (url, success, error) {
          $.ajax({
            url: "rest/" + url,
            type: "GET",
            beforeSend: function (xhr) {
              xhr.setRequestHeader(  //this part beforeSend is needed for tokens
                "Authorization",
                  localStorage.getItem("user_token")
              );
            },
            success: function (data) {
              if (success) toastr.success(data);
            },
            error: function (data) {
              if (error) toastr.error(data);
            },
        });
    },
};

