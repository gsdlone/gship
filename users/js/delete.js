$(document).ready(function($){
   $('#confirmDelete').on('show.bs.modal', function (e) {
	   $id = $(e.relatedTarget).attr('data-id');
	   $count = $(e.relatedTarget).attr('data-count');
	   $(this).find('.modal-body p').text('确定删除第 '+$count+' 篇文章?');
	   $(this).find('.modal-title').text('删除');
	   $(this).find('.modal-val').text($id);
	});

	$('#confirmDelete').find('.modal-footer #confirm').on('click', function(e){
	   i = $('#confirmDelete').find('.modal-val').text();

	   if(i != null) {
	    $.post("delete.php", {
	      id:i
	      },function(){window.location.href='index.php';});
	   }
	});
});
