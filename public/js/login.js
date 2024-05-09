(function ($) {


    $(document).ready(function () {
        $('#formAuthentication').submit(function handleSubmit(e) {
            // Disable the submit button, to prevent multiple submissions
            // then allow the browser to continue with the submission
            alert('Form submitted');
            $(this).find('button[type="submit"]').prop('disabled', true);
            return true;
        });
    });

})(jQuery);
