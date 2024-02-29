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

    $('#payment_paynl_failover_gateway').on('change', function () {
        if ($(this).val() == 'custom') {
            $('#custom_core').show()
        } else {
            $('#custom_core').hide()
        }
    })
})
