jQuery(document).ready(function ($) {
    // Your AJAX call here
    // For example:
    $('#your-button-id').on('click', function () {
        $.ajax({
            url: opsWidgetAjax.ajax_url,
            type: 'post',
            data: {
                action: 'calculate_something',
                // any other data you want to send to the server
            },
            success: function (response) {
                // handle the server response here
            },
            error: function (error) {
                // handle errors here
            },
        });
    });
});
