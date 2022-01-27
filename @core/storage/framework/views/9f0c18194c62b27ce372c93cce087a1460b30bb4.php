

    $('#frontend_darkmode').on('click', function(){
        var el = $(this)
        var mode = el.data('mode');

        $.ajax({
            type:'GET',
            url:  '<?php echo e(route("frontend.dark.mode.toggle")); ?>',
            data:{mode:mode},
            success: function(data){
                location.reload();
            },error: function(){
            }
        });
    });
<?php /**PATH D:\laragon\www\katerio\@core\resources\views/components/frontend/dark-mode.blade.php ENDPATH**/ ?>