$('#send-button').on('click', function () {
    let message = $('#message-form').val();
    if (message.length > 0) {
        console.log(message);
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