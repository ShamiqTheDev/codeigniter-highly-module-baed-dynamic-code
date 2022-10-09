
function getModuleOptions() {
	getOptions('get','moduleOptions','Module','','Module');
}

$(document).ready(function () {
	getModuleOptions();
});

var ckEditorUrl = 'https://cdn.ckeditor.com/4.14.0/full/ckeditor.js';

$.getScript(ckEditorUrl, function()
{
	CKEDITOR.replace( 'content', {
		filebrowserUploadUrl: base_url+'/template/fileUpload',
		on: {
        save: function(evt)
        {
           var ckContent = evt.editor.getData();            
            $('#content').val(ckContent);
			return false;
        }
    }
	});
});

$(document).on('mouseout','.cke_wysiwyg_frame ',function () {
	$('#cke_19').trigger('click');
})

