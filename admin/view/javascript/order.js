$(document).ready(function () {

    $('#payOrderAmount').change(function () {
        $(this).val(parseFloat($.trim($(this).val().replace(/[^0-9\.]/g, ''))).toFixed(2))
    })

    $('#paymodalcancel, #modal-pay .btn-close').click(function () {
        payModelClose()
    })

    $('#payOrderButton').click(function () {
        var message = $('#confirmMessage').val().replace('%amount%', $('#payOrderCurrency').val() + ' ' + $('#payOrderAmount').val());
        $('#payMessage').text(message);
        $('#modal-pay').show();
        $('body').append('<div class="modal-backdrop show"></div>');       
    })

    $('#paymodalconfirm').click(function () {
        ajax($('#ajaxURL').val() + '&amount=' + $.trim($('#payOrderAmount').val()) + '&currency=' + $('#payOrderCurrency').val());
    })

    $('#paymodalclose, #modal-pay-success .btn-close').click(function () {
        window.location.reload(true)
    })

    function payModelClose(){
        $('#payMessage').text('');
        $('#modal-pay').hide();
        $('.modal-backdrop').remove();
    }

    function ajax (url) {
        payModelClose()
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            asynchronous: true,
            success: function (data) {
                console.log(data);
                if (data['error']) {
                    var message = data['error']
                } else if (data['success']) {
                    var message = data['success']
                }              
                $('#paySuccessMessage').text(message);
                $('#modal-pay-success').show();
                $('body').append('<div class="modal-backdrop show"></div>');
            }
        })
    }
})
