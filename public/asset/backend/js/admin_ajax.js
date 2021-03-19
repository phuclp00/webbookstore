(function($) {
    //Pop -up
    $('.option').confirm({
        title: ' Are you sure want to continues ?',
        content: 'This dialog will automatically trigger \'cancel\' in 6 seconds if you don\'t respond.',
        autoClose: 'cancelAction|8000',
        buttons: {
            OK: {
                text: 'OK',
                action: function() {
                    location.href = this.$target.attr('href');
                }
            },
            cancelAction: function() {
                $.alert('Canceled');
            }
        }
    });
    //Serch User List
    $('#search_user').on('keyup', function() {
        var value = $(this).val();
        console.log(value);
        $.ajax({
            type: 'get',
            url: './user_search',
            data: {
                search_user: value
            },
            dataType: "json",
            success: function(data) {
                $('tbody').html(data.result);
                $('#paginate').html("");
                if (data = null) {
                    location.reload();
                }
            }
        });
    })
})(jQuery)