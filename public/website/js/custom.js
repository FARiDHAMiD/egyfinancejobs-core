$(document).ready(function () {
    $('.currently_work_there').on('change', function () {
        let id = $(this).attr('data-id')

        if ($(this).is(':checked')) {
            $('#ending_in-' + id).hide();;
        } else {
            $('#ending_in-' + id).show();;
        }
    });
});
$(document).ready(function () {
    $('.copyLink').click(function (e) {
        e.preventDefault();
        var copyText = $(this).attr('href');
        document.addEventListener('copy', function (e) {
            e.clipboardData.setData('text/plain', copyText);
            e.preventDefault();
        }, true);

        document.execCommand('copy');
        $('.copyMessage').fadeIn().delay(1000).fadeOut();
    });
});
