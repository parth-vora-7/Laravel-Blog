$(function () {
	$('#dob').datetimepicker({
		useCurrent: true,
		format: 'DD-MM-YYYY'
	});

	$('#published_on').datetimepicker({
		useCurrent: true,
		format: 'DD-MM-YYYY hh:mm:ss'
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

	Echo.channel('blog')
    .listen('NewBlogPublished', (e) => {
        console.log(e);
    });
});