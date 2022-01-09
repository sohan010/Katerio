// Newsletter Insert

    $(document).on('click', '.newsletter-form-wrap .submit-btn', function (e) {
        e.preventDefault();
        var email = $('.newsletter-form-wrap input[type="email"]').val();
        var errrContaner = $(this).parent().parent().parent().find('.form-message-show');
        errrContaner.html('');
        var paperIcon = 'fa-paper-plane';
        var spinnerIcon = 'fa-spinner fa-spin';
        var el = $(this);
        el.find('i').removeClass(paperIcon).addClass(spinnerIcon);
        $.ajax({
            url: "<?php echo e(route('frontend.subscribe.newsletter')); ?>",
            type: "POST",
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                email: email
            },
            success: function (data) {
                errrContaner.html('<div class="alert alert-'+data.type+'">' + data.msg + '</div>');
                el.find('i').addClass(paperIcon).removeClass(spinnerIcon);
            },
            error: function (data) {
                el.find('i').addClass(paperIcon).removeClass(spinnerIcon);
                var errors = data.responseJSON.errors;
                errrContaner.html('<div class="alert alert-danger">' + errors.email[0] + '</div>');
            }
        });
    });
<?php /**PATH D:\laragon\www\intoday-update-final\@core\resources\views/components/frontend/newsletter-store.blade.php ENDPATH**/ ?>