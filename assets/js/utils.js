//here, you write methods that repeat, but are not related to anything in specific
//don't forget to declare and initliaze objects at the top!!!!!
var Utils = {
    password_toggle: function(){
        //this is for the password to be seen or invisible
        //first, look for tags with these ids
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // Toggle the eye slash icon
       togglePassword.classList.toggle('bi-eye-slash');
       // Toggle the eye icon
       togglePassword.classList.toggle('bi-eye');});

    },

    toaster: function(){
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "500",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    },

}