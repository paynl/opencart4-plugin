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
            if (!$(e.target).hasClass('clickable')) return
            if (!$(this).hasClass('open')) {
                $('.payPaymentMethod').removeClass('open')
                $(this).addClass('open')
            } else {
                $('.payPaymentMethod').removeClass('open')
            }
        })
    })
    
})
