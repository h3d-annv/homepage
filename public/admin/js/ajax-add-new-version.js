window.onload = function() {
    //Add new operation system
    $("#new-os").click(function () {
        var osn = $('#o').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url:'../download/operation-system/store',
            type:'POST',
            data:{
                os_name: osn
            },
            success: function( data ){
                if(data.success){
                    location.reload();
                }
            },
        })
    })
    //save logs
    function logs(data_log){
        var arr = data_log.substring(1,data_log.length-1);
        arr =  arr.split(',');
        for(var i=0;i<arr.length;i++){
            if( (i%2)=== 0) {
                var syn = arr[i].indexOf("\[");
                if( syn === -1 ) {
                    arr[i] = arr[i].substring(1,arr[i].length-1);
                }
                else
                    arr[i] = arr[i].substring(2, arr[i].length - 2);
            }
            else {
                var syn = arr[i].indexOf("\[");
                if( syn === -1 ) {
                    arr[i] = arr[i].substring(1,arr[i].length-1);
                }
                else
                    arr[i] = arr[i].substring(2,arr[i].length-2);
            }
        }
        var id = arr[0];
        var time = arr[1];
        var ver_old = arr[2];
        var ver_path_old = arr[3];
        var ver_new = arr[4];
        var ver_path_new = arr[5];
        var o = ver_path_new.indexOf("\\");
        var o1 = ver_path_old.indexOf("\\");
        while(o1 !== -1){
            ver_path_old = ver_path_old.replace("\\","");
            o1 = ver_path_old.indexOf("\\");
        }
        while(o !== -1){
            ver_path_new = ver_path_new.replace("\\","");
            o = ver_path_new.indexOf("\\");
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: '../download/log/store',
            type: 'POST',
            data: {
                operation_system_id:id,
                time: time,
                version_old: ver_old,
                version_path_old: ver_path_old,
                version_new: ver_new,
                version_path_new: ver_path_new
            },
            success: function (data) {

            }
        })
    }
    //Add new version
    $('.update_ver').click(function(){
        // e.preventDefault();
        var idBtn= $(this).attr('id');
        var arr = idBtn.split('*');
        var id_os = arr[0];
        var os_name = arr[1];
        $('#os_name').text(os_name);
        $('#add_new').click(function (e) {
            e.preventDefault();
            var version = $('#version').val();
            var path = $('#path').val();
            var des = $('#des').val();
            var author = $('#author').val();
            var is_active = $('#is_active').val();
            $('#update_version').css('display', 'none');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '../download/version/store',
                type: 'POST',
                data: {
                    operation_system_id: id_os,
                    version: version,
                    version_path: path,
                    description: des,
                    author: author,
                    is_active: is_active
                },
                success: function (data) {
                    if (data.success) {
                        var data_log = data.success;
                        logs(data_log);
                        location.reload();
                    }
                },
            })
        })

    })
//change versions for os
    $("select").change(function () {
        var ver_up = $(this).children("option:selected").val();
        var idSelect = $(this).attr('id');
        var arr1 = idSelect.split('*');
        var id = arr1[0];
        var ver_now = arr1[1];
        var r = confirm('Are you sure !');
        if (r) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '../download/version/update',
                type: 'GET',
                data: {
                    id_os: id,
                    version_now: ver_now,
                    version_update: ver_up
                },
                success: function (data) {
                    if (data.success) {
                        logs(data.success);
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
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url:'../download/log/index',
            type:'GET',
            data:{
                operation_system_id: id_os,
            },
            success: function( data ){
                if(data.success) {

                    var array = data.success.substring(1, data.success.length - 1);
                    array = array.split('}');
                    var count = document.querySelectorAll('tr.log_ver');
                    if (count.length <1) {
                        $("h4").append(os_name);
                        for (var tr = 0; tr < array.length - 1; tr++) {
                            var arr = formatDataLog(tr, array);
                            $('tbody.logs').append(
                                '<tr role="row" class="odd log_ver">' +
                                '<td class="text-center">' + arr[0] + '</td>' +
                                '<td class="text-center">' + arr[1] + '</td>' +
                                '<td class="text-center">' + arr[2] + '</td>' +
                                '<td class="text-center">' + arr[3] + '</td>' +
                                '<td class="text-center">' + arr[4] + '</td>' +
                                '</tr>');
                        }
                    }
                }
            },
        })
    })
    //Xử lí dữ liệu lấy từ log
    function formatDataLog(stt,array) {
        var arr = null;
        if (stt === 0) {
            arr = array[0].split(',');
            arr = [arr[2], arr[3], arr[4], arr[5], arr[6]];
            for (var i = 0; i < arr.length; i++) {
                var sym = arr[i].indexOf(":");
                arr[i] = arr[i].substring(sym + 1, arr[i].length);
                arr[i] = arr[i].substring(1, arr[i].length - 1);
                if(i%2 === 0){
                    var syms = arr[i].indexOf("\\");
                    while(syms !== -1){
                        arr[i] = arr[i].replace("\\","");
                        syms = arr[i].indexOf("\\");
                    }
                }
            }

        }
        else {
            arr = array[stt].split(',');
            arr = [arr[3], arr[4], arr[5], arr[6], arr[7]];
            for (var j = 0; j < arr.length; j++) {
                var symb = arr[j].indexOf(":");
                arr[j] = arr[j].substring(symb + 1, arr[j].length);
                arr[j] = arr[j].substring(1, arr[j].length - 1);
                if(j%2 === 0){
                    var symbs = arr[j].indexOf("\\");
                    while(symbs !== -1){
                        arr[j] = arr[j].replace("\\","");
                        symbs = arr[j].indexOf("\\");
                    }
                }
            }
        }
        return arr;
    }
    function removeSymbol(obj,symbol) {
        var symb = obj.indexOf(symbol);
        while(symb !== -1){
            obj = obj.replace(symbol,"");
            symb = obj.indexOf(symbol);
        }
    }
}


