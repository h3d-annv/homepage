window.onload = function(){
    /**
     * Disable / Hide some elements when page loaded
     */
    $('#image').prop('disabled', true);
    $('[id^="description"]').prop('disabled', true);
    $('[id^="description"]').attr('class', 'disabled');
    tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
    $('.mce-top-part').hide();
    $('.btn-submit').hide();
}

/**
 * Enable / Show by admin
 */
function enableEdit(){
    $('#image').prop('disabled', false);
    $('[id^="description"]').prop('disabled', false);
    $('[id^="description"]').attr('class', '');
    tinymce.activeEditor.getBody().setAttribute('contenteditable', true);
    $('.mce-top-part').show();
    $('.btn-submit').show();
    $('.enable-edit').hide();
}