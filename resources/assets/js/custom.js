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

	$(document).on('submit', '.ajax-submit', function(e) {
		var form = $(this);
		var errorContainer = $(form.find('.alert-danger'));
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
				if($('.ajax-content').length) {
					$('.ajax-content').html(result);
					form.find('text, textarea').val(null);
					errorContainer.html('<ul></ul>');
					errorContainer.addClass('hidden');
				}
			},
			error: function(xhr, status, error)
			{
				var errorsHTML = '';
				var errorMsgs = JSON.parse(xhr.responseText);
				if(errorContainer.length && xhr.status == 422) {
					errorContainer.removeClass('hidden');
					$.each(errorMsgs, function(field, errors) {
						$.each(errors, function(index, error) {
							errorsHTML = errorsHTML + '<li>' + error + '</li>';
						}); 
					}); 
					errorContainer.html(errorsHTML);
				}
			}
		});
	});

	$(document).on('click', '.ajax-pagination a', function(e) {
		e.preventDefault();
		var action = $(this).attr('href');
		$('.ajax-content').load(action);
	});

	$(document).on('click', 'a.edit-comment', function(e) {
		e.preventDefault();
		var commentEditForm = $(this).closest('.comment').find('form.comment-edit-form');
		if($(this).text() == 'Save') {
			commentEditForm.submit();
		} else {
			commentEditForm.find('blockquote').addClass('hidden');
			commentEditForm.find('textarea').removeClass('hidden');
			$(this).text('Save');
			$(this).closest('.comment').find('.edit-comment-cancel').removeClass('hidden');
		}
	});

	$(document).on('click', 'a.edit-comment-cancel', function(e) {
		e.preventDefault();
		var commentEditForm = $(this).closest('.comment').find('form.comment-edit-form');
		commentEditForm.find('textarea').val(commentEditForm.find('blockquote').text());
		commentEditForm.find('blockquote').removeClass('hidden');
		commentEditForm.find('textarea').addClass('hidden');
		$(this).closest('.comment').find('.edit-comment').text('Edit');
		$(this).closest('.comment').find('.edit-comment-cancel').addClass('hidden');
	});

	$(document).on('click', 'a.sub-comment', function(e) {
		e.preventDefault();
		/*var commentEditForm = $(this).closest('.comment').find('form.comment-edit-form');
		if($(this).text() == 'Save') {
			commentEditForm.submit();
		} else {
			commentEditForm.find('blockquote').addClass('hidden');
			commentEditForm.find('textarea').removeClass('hidden');
			$(this).text('Save');
			$(this).closest('.comment').find('.edit-comment-cancel').removeClass('hidden');
		}*/
	});

	Echo.channel('blog')
	.listen('NewBlogPublished', (e) => {
		console.log(e);
	});
});