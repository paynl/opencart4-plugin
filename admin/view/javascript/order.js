$(document).ready(function () {
    $('#payOrderAmount').change(function () {
        $(this).val(parseFloat($(this).val()).toFixed(2))
    })

    $('#payOrderButton').click(function () {
        if ($('#payOrderAmount').val()) {
            if (confirm($('#confirmMessage').val().replace('%amount%', $('#payOrderCurrency').val() + ' ' + $('#payOrderAmount').val())) == true) {
                ajax($('#ajaxURL').val() + '&amount=' + $('#payOrderAmount').val() + '&currency=' + $('#payOrderCurrency').val())
            }
        }
    })

    function ajax (url) {
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            asynchronous: true,
            success: function (data) {
                if (data['error']) {
                alert(data['error'])
                } else if (data['success']) {
                alert(data['success'])
                window.location.reload(true)
                }
            }
        })
    }
})
