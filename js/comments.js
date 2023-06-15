$(document).ready(function(){ 
	showComments();
	$('#commentForm').on('submit', function(event){
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: "./comments.php",
			method: "POST",
			data: formData,
			dataType: "JSON",
			success:function(response) {
				if(!response.error) {
					$('#commentForm')[0].reset();
					$('#commentId').val('0');
					$('#messagesss').html(response.message);
					showComments(); // Call the function to show updated comments
				} else {
					$('#messagesss').html(response.message);
				}
			}
		});
	});	
	$(document).on('click', '.reply', function(){
		var commentId = $(this).attr("id");
		$('#commentId').val(commentId);
		console.log("Setting focus");
		$('#comment').focus();
	});
});


// function to show comments
function showComments()	{
	$.ajax({
		url:"./show_comments.php",
		method:"GET",
		success:function(response) {
			$('#showComments').html(response);
		}
	});
}
