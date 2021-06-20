(function($) {
    $('.option-edit').confirm({
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
    $('.option-delete').confirm({
        title: ' Are you sure want to delete this ? If not, click cancel to exit !',
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
    $('.option-restore').confirm({
        title: ' Are you sure want to restore this ? If not, click cancel to exit !',
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
    //Check form input book
    $('#author').click(function() {
        $('#new_author').prop("readonly", true).val("");
    });
    $('#new_author').click(function() {
        $(this).prop("readonly", false);
        $('#author').val("");
    })
    $('#format').click(function() {
        $('#new_format').prop("readonly", true).val("");
    });
    $('#new_format').click(function() {
        $(this).prop("readonly", false);
        $('#format').val("");
    })
    $('#translator').click(function() {
        $('#new_translator').prop("readonly", true).val("");
    });
    $('#new_translator').click(function() {
        $(this).prop("readonly", false);
        $('#translator').val("");
    });
    $('#series').click(function() {
        $('#new_series').prop("readonly", true).val("");
    });
    $('#new_series').click(function() {
        $(this).prop("readonly", false);
        $('#series').val("");
    });
    $('#promo-button').click(function() {
        if ($('#promotion').prop("disabled") == false) {
            $('#promotion').prop("disabled", true).val("");
            $(this).removeClass("btn-primary").addClass("btn-danger").text("Enable Promotion");
        } else {
            $('#promotion').prop("disabled", false);
            $(this).removeClass("btn-danger").addClass("btn-primary").text("Disable Promotion");
        }
    });
    $('#series-button').click(function() {
        if ($('#series').prop("disabled") == false) {
            $('#episode').prop("disabled", true).val("");
            $('#series').prop("disabled", true).val("");
            $('#new_series').prop("disabled", true).val("");
            $(this).removeClass("btn-primary").addClass("btn-danger").text("Enable Series");
        } else {
            $('#series').prop("disabled", false);
            $('#episode').prop("disabled", false);
            $('#new_series').prop("disabled", false);
            $(this).removeClass("btn-danger").addClass("btn-primary").text("Not In Series");
        }
    });

})(jQuery)