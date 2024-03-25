$(document).ready(function () {

    $('#sortable_paymentmethods').sortable({
        handle: '.sortHandle',
        placeholder: 'highlight',
        axis: 'y',
        update: function () {
            $(this).find('.payPaymentMethod').each(function (index) {
                $(this).find('.paymentMethodSort').val(index + 1)
            })
        }
    })

    $('.payPaymentMethod').each(function () {
        $(this).click(function (e) {
            if ($(e.target).hasClass('clickable')) {            
                if (!$(this).hasClass('open')) {
                    $('.payPaymentMethod').removeClass('open')
                    $(this).addClass('open')
                } else {
                    $('.payPaymentMethod').removeClass('open')
                }
            }
        })
    })

    $("#check_version_submit").click(function (e) {
        e.preventDefault();
        var ajaxurl = $('#pay_checkversion_url').val();
        var data = {
            'versionCheck' : $('#pay_current_version').val()
        };
        $('#paynl_version_check_result').hide();
        $('#paynl_version_check_loading').css('display', 'block');
        setTimeout(function () {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    let result = '';
                    if (!data) {
                        result = 'Something went wrong, please try again later'
                    } else {
                        var newest_version = data.version.substring(1);
                        var current_version = $('#pay_current_version').val();
                        if (newest_version > current_version) {
                            result = 'There is a new version available (' + data.version + ')'
                        } else {
                            $('#check_version_submit').hide();
                            result = 'You are up to date with the latest version'
                            $('#paynl_version_check_current_version').addClass('versionUpToDate');
                        }
                    }
                    $('#paynl_version_check_result').html(result);
                    $('#paynl_version_check_result').css('display', 'block');
                    $('#paynl_version_check_loading').hide();
                },
                error: function () {
                    result = 'Something went wrong, please try again later'
                    $('#paynl_version_check_result').html(result);
                    $('#paynl_version_check_result').css('display', 'block');
                    $('#paynl_version_check_loading').hide();
                }
            });
        }, 750);
    });

    $('#suggestions_form_submit').click(function () {
        $('#email_error').hide()
        $('#message_error').hide()
        var email = $('#suggestions_form_email').val()
        var message = $('#suggestions_form_message').val()

        var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]/i
        if ($.trim(message) == '' || ($.trim(email) != '' && !regex.test($('#suggestions_form_email').val()))) {
            if ($.trim(email) != '' && !regex.test($('#suggestions_form_email').val())) {
            $('#email_error').css('display', 'inline')
            }
            if ($.trim(message) == '') {
            $('#message_error').css('display', 'inline')
            }
            return false
        }

        var ajaxurl = $('#pay_suggestions_url').val()
        var pluginversion = $('#pay_plugin_version').val()
        var data = {
            'email': email,
            'message': message,
            'pluginverison': pluginversion
        }
        setTimeout(function () {
            $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                $('#suggestions_form_email').val('')
                $('#suggestions_form_message').val('')
                $('#suggestions_form_success').modal('show')
                } else {
                $('#suggestions_form_fail').modal('show')
                }
            },
            error: function () {
                $('#suggestions_form_fail').modal('show')
            }
            })
        }, 750)
    })

    $('#suggestions_form_success .close').click(function () {
        $('#suggestions_form_success').modal('hide')
    })

    $('#suggestions_form_fail .close').click(function () {
        $('#suggestions_form_fail').modal('hide')
    })

    $('.show_translations').click(function () {
        $(this).find('i').toggleClass('fa-chevron-down')
        $(this).find('i').toggleClass('fa-chevron-up')
        $(this).parent().find('.language-options').toggleClass('hidden')
    })
})
