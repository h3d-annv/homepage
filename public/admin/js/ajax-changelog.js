window.onload = function () {
    $("#btn-add").click(function(e) {
        e.preventDefault();
        $('#add-changelog').submit( function (e) {
            e.preventDefault();
            var fd = new FormData($(this)[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '../admin/changelog/store',
                type: 'POST',
                data:fd,
                dataType:'json',
                cache:false,
                processData: false,
                contentType:false,
                success: function(data){
                    if(data.success){
                        location.reload();
                    }
                },
                errors: function (data) {
                    alert(data.status);
                }
            })
        })
    });

    $(".btn-update").click(function(e) {
        var url = $(this).attr('data-url');
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            type: 'get',
            url: url,
            success: function (response) {
                console.log(response);
                $('#id').val(response.data.id);
                $('#version-update').val(response.data.version);
                $('#changelog-update').val(response.data.changelog);
                CKEDITOR.instances['changelog-update'].setData(response.data.changelog);
            }
        });
    });

    $('#update-changelog').submit(function (e){
        e.preventDefault();
        var url='../admin/changelog/modify';
        var version = $('#version-update').val();
        var changelog = $('#changelog-update').val();
        var updated_by = $('#user').val();
        var id = $('#id').val();
        var fd = new FormData();
        fd.append('version', version);
        fd.append('changelog', CKEDITOR.instances['changelog-update'].getData());
        fd.append('id', id);
        fd.append('updated_by', updated_by);
        for (var i of fd.entries()) {
            console.log(i[0] + ' ' + i[1]);
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            method: 'POST',
            url: url,
            data: fd,
            dataType:'json',
            cache:false,
            processData: false,
            contentType:false,
            success: function(data){
                if(data.success){
                    location.reload();
                }
            },
            errors: function (data) {
                alert(data.status);
            }
        })
    });
}