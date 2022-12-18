$(document).ready(function() 
{
    $('#btnSearch').on('click', function() 
    {
        var searchInput = $('.searchInput').val();
        var url = $(this).data('url');
        console.log(searchInput);
        console.log(url);
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                searchInput: searchInput,
            },
            success: function(data) {
                $('#list').html(data);
            },
        });
    });
});

