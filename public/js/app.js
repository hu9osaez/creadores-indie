$(document).ready(function () {
    $('#burger-navbar').on('click', function (e) {
        e.preventDefault();

        let self = $(this);
        let $target = $('#' + self.data('target'));

        self.toggleClass('is-active');
        $target.toggleClass('is-active');
    });

    $('.feedback-box .feedback-box__title').on('click', function(e) {
        e.stopPropagation();
        e.preventDefault();

        $('.feedback-box').toggleClass('opened');

        if ($('.feedback-box').hasClass('opened')) {
            $('.feedback-box .fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        }
        else {
            $('.feedback-box .fa').addClass('fa-chevron-up').removeClass('fa-chevron-down');
        }
    });

    $('.feedback-box button').on('click', function() {
        var $fbName = $('.feedback-box #name');
        var $fbEmail = $('.feedback-box #email');
        var $fbMessage = $('.feedback-box #message');

        if ($fbName.val().trim() === '' || $fbEmail.val().trim() === '' || $fbMessage.val().trim().length === 0) {
            alert('Por favor completa todos los campos.');
            return;
        }

        if (!validateEmail($fbEmail.val())) {
            alert('El correo electrónico ingresado no es válido.');
            return;
        }

        $.ajax({
            url: CI.feedbackUrl,
            dataType: 'json',
            type: 'POST',
            data: {
                _token: CI.csrfToken,
                name: $fbName.val(),
                email: $fbEmail.val(),
                message: $fbMessage.val().trim()
            },
        })
        .done(function(response) {
            if (response.success) {
                $('.feedback-box #feedback-form').remove();
                $('.feedback-box__body').addClass('success');
                $('.feedback-box #success').html(response.message);
            } else {
                alert(response.message);
            }
        });
    });
});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
