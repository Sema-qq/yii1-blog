$(document).ready(function () {
    $('.captcha').on('click', function () {
        $(this).get(0).src = '/auth/captcha?' + Math.random();
    });
});
