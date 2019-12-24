$(document).ready(function() {
    $('#send-button').on('click', function () {
        let message = $('#message-form').val();
        if (message.length > 0) {
            $.ajax({
                method: 'POST',
                url: ajaxUrl,
                data: {
                    'message': message
                }
            });
            location.reload();
        }
    });
});
