
$('#frontend_darkmode').on('click', function(){
var el = $(this)

var mode = el.data('mode');


$.ajax({
type:'GET',
url:  '<?php echo e(route("frontend.dark.mode.toggle")); ?>',
data:{mode:mode},
success: function(){
location.reload();
},error: function(){
}
});
});<?php /**PATH D:\laragon\www\in-today\@core\resources\views/components/frontend/dark-mode.blade.php ENDPATH**/ ?>