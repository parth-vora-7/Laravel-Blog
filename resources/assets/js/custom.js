$(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': window.Laravel.csrfToken
		}
	});

	$('#dob').datetimepicker({
		useCurrent: true,
		format: 'DD-MM-YYYY'
	});

	$('#published_on').datetimepicker({
		useCurrent: true,
		format: 'DD-MM-YYYY HH:mm:ss'
	});

	$("#tags").select2({
		tags: true,
		createTag: function (tag) {
			return {
				id: tag.term,
				text: tag.term,
				isNew : true
			};
		}
	}).on("select2:select", function(e) {
		if(e.params.data.isNew) {
			var newTagName = e.params.data.text;
			var hiddenInput = $('<input/>',{type:'hidden', value:newTagName, name: 'new_tags[]'});
			hiddenInput.appendTo('.tags-container');
		}
	});

	$('.checkbox, .radio').iCheck({
		checkboxClass: 'icheckbox_flat-yellow',
		radioClass: 'iradio_flat-yellow',
		labelHover: false,
		cursor: true
	});

	function alertFadeOut() {
		$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
			$(".alert-success").slideUp(500);
		});
	}

	$(document).on('submit', '.ajax-submit', function(e) {
		var form = $(this);
		var errorContainer = $(form.find('.error-container'));
		e.preventDefault();
		var formData = $(this).serialize();
		var action = $(this).attr('action');
		var method = $(this).attr('method');
		$.ajax({
			type: method,
			url: action,
			data: formData,
			success: function(result)
			{
				if(form.hasClass('fcomment')) {
					if($('.ajax-content').length) {
						if(form.hasClass('comment-add-form')) {
							$(form).closest('.comment-container').find('.ajax-content').html(result).slideDown();
						} else if (form.hasClass('comment-edit-form') || form.hasClass('comment-delete-form')) {
							$(form).parents('.comment-container').eq(1).find('.ajax-content').html(result);	
						}
						alertFadeOut();
						form.find('text, textarea').val(null);
						errorContainer.find('p').remove();
						errorContainer.addClass('hidden');
					}
				}
			},
			error: function(xhr, status, error)
			{
				if(form.hasClass('fcomment')) {
					var errorsHTML = '';
					var errorMsgs = JSON.parse(xhr.responseText);
					if(errorContainer.length && xhr.status == 422) {
						errorContainer.removeClass('hidden');
						$.each(errorMsgs, function(field, errors) {
							$.each(errors, function(index, error) {
								errorsHTML = errorsHTML + '<p>' + error + '</p>';
							});
						}); 
						errorContainer.removeClass('.hidden');
						errorContainer.find('p').remove();
						errorContainer.find('.alert-danger').append(errorsHTML);
					}
				}
			}
		});
	});

	$(document).on('click', '.ajax-pagination a', function(e) {
		e.preventDefault();
		var action = $(this).attr('href');
		$(this).closest('.comment-container').find('.ajax-content').load(action);
	});

	$(document).on('click', 'a.edit-comment', function(e) {
		e.preventDefault();
		var commentId = $(this).data('comment-id');
		var commentContainer = $('#comment-' + commentId); 
		var commentEditForm = $('#comment-edit-form-' + commentId);

		if($(this).text() == 'Save') {
			commentEditForm.submit();
		} else {
			commentEditForm.find('blockquote').addClass('hidden');
			commentEditForm.find('textarea').removeClass('hidden');
			$(this).text('Save');
			$(commentContainer).find('.edit-comment-cancel').removeClass('hidden');
		}
	});

	$(document).on('click', 'a.edit-comment-cancel', function(e) {
		e.preventDefault();
		
		var commentId = $(this).data('comment-id');
		var commentContainer = $('#comment-' + commentId); 
		var commentEditForm = $('#comment-edit-form-' + commentId);

		commentEditForm.find('textarea').val(commentEditForm.find('blockquote').text());
		commentEditForm.find('blockquote').removeClass('hidden');
		commentEditForm.find('textarea').addClass('hidden');
		commentContainer.find('.edit-comment').text('Edit');
		commentContainer.find('.edit-comment-cancel').addClass('hidden');
	});
	
	$(document).on('click', 'a.add-comment', function(e) {
		e.preventDefault();
		if($(this).hasClass('comment-collapse')) {
			var action = $(this).attr('href');
			$(this).closest('.comment-container').find('.ajax-content').load(action);
			$(this).find('i').removeClass('fa-arrow-down').addClass('fa-arrow-up');
		} else {
			$(this).closest('.comment-container').find('.ajax-content').html(null);
			$(this).find('i').removeClass('fa-arrow-up').addClass('fa-arrow-down');
		}
		$(this).toggleClass('comment-collapse');
	});
	
	/*Echo.channel('blog')
	.listen('NewBlogPublished', (e) => {
		console.log(e);
	});*/
});