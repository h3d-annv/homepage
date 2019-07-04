window.onload = function() {
    //Add new operation system
    $("#new-os").submit(function (e) {
        e.preventDefault();
        $('#text_err').remove();
        var dataObj = new FormData($(this)[0]);
        var url = '../download/operation-system/store';
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
                if (res.success === "Success") {
                    location.reload();
                }
                else if(res.success === "Exits"){
                    $('#err').append('<strong style="color:red;" id="text_err">Operation System exists</strong>');
                }
                else{
                    alert('Fails');
                }
            }
        })

    })

    //save logs
    function format(data) {
        if(data.indexOf("\[") !== -1){
           return data[0];
        }else{
            return data;
        }
    }
    function logs(data_log){
       var fd = new FormData();
       fd.append('operation_system_id',format(data_log.operation_system_id));
       var t = format(data_log.time).toString();
       t = t.substring(0,t.length-8);
       var arrDate = t.split('T');
       var date = arrDate[0].split('-');
       var time = arrDate[1].split(':');
       time[0] = parseInt(time[0],10) + 7;
       t = new Date(date[0],parseInt(date[1],10)-1,date[2],time[0],time[1],time[2]);
       fd.append('time',t.toString().substring(0,t.toString().length-17));
       fd.append('version_old',format(data_log.version_old));
       fd.append('version_path_old',format(data_log.version_path_old));
       fd.append('version_new',format(data_log.version_new));
       fd.append('version_path_new',format(data_log.version_path_new));
       fd.append('updated_by',format(data_log.updated_by));
       fd.append('operation_system_id',format(data_log.operation_system_id));
        for (var i of fd.entries()) {
            console.log(i[0] + ' ' + i[1]);
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: '../download/log/store',
            method: 'POST',
            data: fd,
            dataType: false,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {

            }
        })
    }
    //Add new version
    $('.update_ver').click(function(e){
        e.preventDefault();
        var idBtn= $(this).attr('id');
        var arr = idBtn.split('*');
        $('#operation_system_id').val(arr[0]);
        $('#os_name').text(arr[1]);
        $('#version').val('');
        $('#version_path').val('');
        $('#description').val('');
        $('#box-err').remove();
        $('#add_new').submit(function (e) {
            e.preventDefault();
            var dataObj = new FormData($(this)[0]);
            var url = '../download/version/store';
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
                        var d = JSON.parse(res.success);
                        logs(d);
                        location.reload();
                    } else {
                        alert('Failed');
                    }
                },
                error: function (d) {
                    if( d.status === 422 ) {
                        var err = d.responseJSON;
                        errorsHtml = '<div class="alert alert-danger" id="box-err"><ul>';
                        $.each( err.errors, function( key, value ) {
                            errorsHtml += '<li>' + value[0] + '</li>';
                        });
                        errorsHtml += '</ul></di>';
                        $( '#form-errors' ).html( errorsHtml );
                    }
                }
            })
        })
    })
//change versions for os
    $("select").change(function (e) {
        e.preventDefault();
        var ver_up = $(this).children("option:selected").val();
        var idSelect = $(this).attr('id');
        var arr1 = idSelect.split('*');
        var id = arr1[0];
        var ver_now = arr1[1];
        var user_up = arr1[2];
        var ver_old_path = $(this).data('status');
        var r = confirm('Are you sure !');
        if (r) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '../download/version/update',
                method: 'GET',
                data: {
                    operation_system_id: id,
                    version_now: ver_now,
                    version: ver_up,
                    created_by:user_up,
                    version_old_path:ver_old_path
                },
                dataType: false,
                cache: false,
                success: function (data) {
                    if (data.success) {
                        var d = JSON.parse(data.success);
                        logs(d);
                        location.reload();
                    }
                },
            })
        }
    })
//show data logs of os
    $('.btnLog').click(function(e){
        e.preventDefault();
        var idBtn= $(this).attr('id');
        var arr = idBtn.split('*');
        var id_os = arr[0];
        var os_name = arr[1];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url:'../download/log/index',
            method:'GET',
            data:{
                operation_system_id: id_os,
            },
            dataType: false,
            cache: false,
            success: function( data ){
                if(data.success) {
                    var d = JSON.parse(data.success);
                    var count = document.querySelectorAll('tr.log_ver');
                    if (count.length <1) {
                        $("h4").append('Lịch sử thay đổi '+os_name);
                        for (var tr = 0; tr < d.length ; tr++) {
                            $('tbody.logs').append(
                                '<tr role="row" class="odd log_ver">' +
                                '<td class="text-center">' +  d[tr].time+ '</td>' +
                                '<td class="text-center">' + d[tr].updated_by + '</td>' +
                                '<td class="text-center">' + d[tr].version_old + '</td>' +
                                '<td class="text-center">' + d[tr].version_path_old + '</td>' +
                                '<td class="text-center">' + d[tr].version_new + '</td>' +
                                '<td class="text-center">' + d[tr].version_path_new + '</td>' +
                                '</tr>');
                        }
                    }
                }
            },
        })
    })
    $('.closeLog').click(function (e) {
        e.preventDefault();
        $('h4').text('');
        $('.log_ver').remove();
    })

}


