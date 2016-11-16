$(function () {
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

	Echo.channel('blog')
	.listen('NewBlogPublished', (e) => {
		console.log(e);
	});
});