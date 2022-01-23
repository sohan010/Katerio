    $('.load-ajax-data').hide();
    $(document).on('click','.category-btn',function(e){
        e.preventDefault();
        let el = $(this);
        var id = $(this).data('id');

        $.ajax({
        url: "<?php echo e(route('frontend.get.blogs.by.ajax')); ?>",
        type: 'get',
        data:{id:id},

            beforeSend: function (){
              $('.load-ajax-data').show();
            },
              success: function(data){
                 $('.load-ajax-data').hide();
                 $('.home-page-ajax-news-show').html(data.markup);
            }

      });


});
<?php /**PATH D:\laragon\www\katerio\@core\resources\views/components/frontend/blog-by-ajax.blade.php ENDPATH**/ ?>