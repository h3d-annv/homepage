$(document).ready(function(){
    // Convert name to slug
    $('#name').change(function(){
        var slug = to_slug($('#name').val());
        $('#slug').val(slug);
    });
    // Convert title to slug
    $('#title_en').change(function(){
        var slug = to_slug($('#title_en').val());
        $('#slug').val(slug);
    });

    // Remove item
    $('.btnRemove').click(function(){
        var id = $(this).data('id');
        var url = $(this).data('url');
        var _token = $(this).data('token');

        if(confirm('Do you really want to delete this item?')){
            remove(id, url, _token)
        }
    });

    $('.btnActivate').click(function(){
        var id = $(this).data('id');
        var status = $(this).data('status');
        var url = $(this).data('url');
        var _token = $(this).data('token');

        var changeToStatusText = (status == 1) ? 'deactive' : 'active';

        if(confirm('Do you really want to ' + changeToStatusText + ' this item?')){
            updateStatus(id, url, _token, status)
        }
    });

    $('.inputSort').change(function(){
        var id = $(this).data('id');
        var url = $(this).data('url');
        var _token = $(this).data('token');
        var sortNo = $(this).val();
        if(confirm('Do you really want to change order value of this item?')){
            sort(id, url, _token, sortNo);
        }
    });

    var editor_config = {
        path_absolute : "/",
        selector: ".tinymce",
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help'
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            console.log(editor_config.path_absolute);
            var cmsURL = editor_config.path_absolute + '/laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

    tinymce.init(editor_config);



    ProductCategory.init();
    Product.init();
});

function remove(id, url, _token){
    $.ajax({
        method: 'DELETE',
        url: url,
        data: {
            id: id,
            _token: _token,
        },
        success: function(res){
            if(res === 'Deleted'){
                alert('Done');
            }else{
                alert('Failed');
            }
            window.location.reload();
        }
    });
}

function updateStatus(id, url, _token, status){
    $.ajax({
        method: 'PUT',
        url: url,
        data: {
            id: id,
            status: status,
            _token: _token,
        },
        success: function(res){
            if(res === 'Done'){
                alert('Done');
            }else{
                alert('Failed');
            }
            window.location.reload();
        }
    });
}

function sort(id, url, _token, sortNo){
    $.ajax({
        method: 'PUT',
        url: url,
        data: {
            id: id,
            sortNo: sortNo,
            _token: _token,
        },
        success: function(res){
            if(res === 'Done'){
                alert('Done');
            }else{
                alert(res);
            }
            window.location.reload();
        }
    });
}

// Build slug string
function to_slug(str){
    str = str.toLowerCase();

    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');

    str = str.replace(/([^0-9a-z-\s])/g, '');

    str = str.replace(/(\s+)/g, '-');

    str = str.replace(/^-+/g, '');

    str = str.replace(/-+$/g, '');

    // return
    return str;
}
function  addNewObj(url, dataObj) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: 'POST',
        url: url,
        data:dataObj,
        dataType: false,
        cache: false,
        processData: false,
        contentType: false,
        success: function (res) {
            if (res.success) {
                console.log(res.success);
                location.reload();
            }
        },
        error: function (d) {
            if( d.status === 422 ) {
                var err = d.responseJSON;
                errorsHtml = '<div class="alert alert-danger"><ul>';
                $.each( err.errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                errorsHtml += '</ul></di>';
                $( '#form-errors' ).html( errorsHtml );
            }
        }
    })
}
