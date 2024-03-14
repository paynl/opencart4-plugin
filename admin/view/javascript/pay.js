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
