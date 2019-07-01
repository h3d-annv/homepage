window.onload = function () {
    $("#btn-add").click(function(e) {
        e.preventDefault();
        $('#btn-submit').click('submit', function () {
            var link_vr = $('#link-add').val();
            var image_vr = $('#image-add')[0].files[0];
            var active = $('#is_active-add').val();
            var user = $('#user').val();
            var fd = new FormData();
            fd.append('link', link_vr);
            fd.append('image', image_vr);
            fd.append('is_active',active);
            fd.append('created_by', user);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '../admin/vr-gallery/store',
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

    // $(".btn-edit").click(function(e) {
    //     var url = $(this).attr('data-url');
    //     e.preventDefault();
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type: 'get',
    //         url: url,
    //         success: function (response) {
    //             console.log(response);
    //             $('#vrId').val(response.data.id);
    //             $('#link-edit').val(response.data.link);
    //             $('#currentImg').val(response.data.image);
    //         }
    //     });
    // });
    // $('#edit-vr').submit(function (e){
    //     e.preventDefault();
    //     var url='../admin/vr-gallery/modify';
    //     var link_vr = $('#link-edit').val();
    //     var image_vr = $('#image-edit')[0].files[0];
    //     var id = $('#vrId').val();
    //     var fd = new FormData();
    //     fd.append('link', link_vr);
    //     fd.append('image', image_vr);
    //     fd.append('id', id);
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     jQuery.ajax({
    //         type: 'PUT',
    //         url: url,
    //         data: fd,
    //         dataType:'json',
    //         cache:false,
    //         processData: false,
    //         contentType:false,
    //         success: function(data){
    //             if(data.success){
    //                 alert(data.success);
    //             }
    //         },
    //         errors: function (data) {
    //             if(data.status === 422 ){
    //                 alert('error 422');
    //             }
    //         }
    //     })
    // });

    $('#btn-add-activate').click(function (e) {
        e.preventDefault();
        $(this).toggleClass('btn-danger');
        if($(this).attr('class') === "btn btn-success btn-danger"){
            $(this).text('Disabled');
            $('#is_active-add').val("0");
        }
        else{
            $(this).text('Enabled');
            $('#is_active-add').val("1");
        }
    });
}
