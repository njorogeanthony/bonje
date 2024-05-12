(function ($) {
    $(document).ready(function () {
        // Add an event listener to the amount field
        $('#amount').on('input', function () {
            // Fetch the value of the amount field
            var amount = $(this).val();

            // Fetch the vat percentage
            var vat = $('#vatpercentage').val();

            // Calculate the vat amount
            var vatAmount = (amount * vat) / 100;

            // Calculate the total amount
            var totalAmount = parseFloat(amount) + parseFloat(vatAmount);

            // Set the value of the vat amount field to 2 decimal places
            $('#vatamount').val(vatAmount.toFixed(2));

            // Set the value of the total field
            $('#total').val(totalAmount.toFixed(2));
        });
    });
})(jQuery)
