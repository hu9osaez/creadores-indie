$(document).ready(function () {
    $('#burger-navbar').on('click', function (e) {
        e.preventDefault();

        let self = $(this);
        let $target = $('#' + self.data('target'));

        self.toggleClass('is-active');
        $target.toggleClass('is-active');
    });

    $('.feedback-box .feedback-box__title').bind('click', function(e) {
        e.stopPropagation();
        e.preventDefault();

        toggleFeedbackBox();
    });

    function toggleFeedbackBox() {
        $('.feedback-box').toggleClass('opened');
    }
});
