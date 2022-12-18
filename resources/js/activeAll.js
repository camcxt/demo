
$(document).ready(function() 
{
    $('.toggle-position').on('change', function() 
    {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                status: status,
                id: id,
            },
            success: function(data) {
                $('#' + result).html(data);
            },
        });
    });
});
