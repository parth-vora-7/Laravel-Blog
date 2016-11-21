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
		var form = this;
		e.preventDefault();
		var formData = $(this).serialize();
		var action = $(this).attr('action');
		var method = $(this).attr('method');
		$.ajax({
			type: method,
			url: action,
			data: formData,
			success: function(data)
			{
				if($('.ajax-content').length) {
					$('.ajax-content').html(data);
					$(form).find('text, textarea').val(null);
				}
			}
		});
	});

	$(document).on('click', '.ajax-pagination a', function(e) {
		e.preventDefault();
		var action = $(this).attr('href');
		$('.ajax-content').load(action);
	});

	Echo.channel('blog')
	.listen('NewBlogPublished', (e) => {
		console.log(e);
	});
});