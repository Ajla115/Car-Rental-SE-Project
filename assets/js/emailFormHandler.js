var EmailService = {
    init: function() {
        // Initialize the form handler
        $('.php-email-form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = $(this).serialize(); // Serialize the form data
            EmailService.sendEmail(formData); // Call the sendEmail function
        });
    },

    sendEmail: function(formData) {
        $.ajax({
            type: "POST",
            url: "./rest/mail.php",
            data: formData,
            dataType: "json",
            encode: true,
            beforeSend: function() {
                $('.loading').show(); // Show loading indicator
                $('.error-message').hide(); // Hide error messages initially
                $('.sent-message').hide(); // Hide the sent message initially
            },
            success: function(data) {
                if (data.status === "success") {
                    $('#success-message').html(data.response).show().addClass('blur-out');
                } else {
                    $('.error-message').html(data.response).show().addClass('blur-out');
                }
                // Attach animationend event listeners
                $('#success-message, .error-message').one('animationend', function() {
                    $('.loading').hide(); // Hide the loading indicator after the animation ends
                });
            },
            error: function() {
                $('.error-message').html('An error occurred. Please try again.').show().addClass('blur-out');
                $('.error-message').one('animationend', function() {
                    $('.loading').hide(); // Hide the loading indicator after the animation ends
                });
            }
        });
    }
};
