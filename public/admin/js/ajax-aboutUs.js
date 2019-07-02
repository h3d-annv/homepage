$(document).ready(function() {
    //Add new intro
    $('.btnAddIntro').click(function (e) {
        e.preventDefault();
        if($(this).attr('id') === 'Add'){
            var url = '../about-us/intro/store';

            $('#intro').modal('show');
            $('#image').on("change", function () {
                $('.glyphicon-plus-sign').remove();
                $('.img_box').append('<img src=""  id="img"  class="img-responsive" style="width:100%">');
                $("#img").attr("src", URL.createObjectURL(this.files[0]));

            })
            $('#form_intro').submit(function (e) {
                e.preventDefault();
                var dataObj = new FormData($(this)[0]);
                addNewObj(url,dataObj);
                $('.img_box').remove();
            })
        }
        if($(this).attr('id') === 'Update'){
            $('#form_intro').append('<input type="hidden" name="current_image" id="current_image" value="">'+'<input type="hidden" name="id" id="id" value="">');
            var urlGet = '../about-us/intro/getData';
            $('#id').val($(this).data('status'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'GET',
                url: urlGet,
                data:{
                    'id':$(this).data('status')
                },
                dataType: false,
                cache: false,
                success: function (res) {
                    if (res.success) {
                        alert('Done');
                        console.log(res.success);
                        var d = JSON.parse(res.success.substring(1, res.success.length - 1));
                        console.log(d);
                        $('#id').val(d.id);
                        $('#title_vi').val(d.title_vi);
                        $('#title_en').val(d.title_en);
                        $('.glyphicon-plus-sign').remove();
                        $('.img_box').append('<img src=../../uploads/' + d.image + ' width="100%" id="img" class="img-responsive" alt>');
                        $('#current_image').val(d.image);
                        CKEDITOR.instances['content_vi'].setData(d.content_vi);
                        $('#content_vi').val(d.content_vi);
                        $('#content_en').val(d.content_en);
                        CKEDITOR.instances['content_en'].setData(d.content_en);
                        $('#intro').modal('show');
                        $('#image').on("change", function () {
                            $("#img").attr("src", URL.createObjectURL(this.files[0]));
                        })
                        $('#form_intro').submit(function (e) {
                            e.preventDefault();
                            var dataObj = new FormData($(this)[0]);
                            var urlUp = '../about-us/intro/modify';
                            $('.img_box').append('<span class="glyphicon glyphicon-plus-sign" style="font-size: 150px;left: 25%;top:25%"></span>');
                            $('#current_image').remove();
                            $('#id').remove();
                            addNewObj(urlUp,dataObj);

                        })
                        // location.reload();
                    } else {
                        alert('Failed');

                    }
                }
            })

        }

    })
    //
    $('.btnAddVision').click(function (e) {
        e.preventDefault();
        if($(this).attr('id') === 'Add'){
            var url = '../about-us/vision/store';

            $('#vision').modal('show');
            $('#icon').on("change", function () {
                $('.glyphicon-plus-sign').remove();
                $('.img_box').append('<img src=""  id="img"  class="img-responsive" style="width:100%">');
                $("#img").attr("src", URL.createObjectURL(this.files[0]));
            })
            $('#form_vision').submit(function (e) {
                e.preventDefault();
                var dataObj = new FormData($(this)[0]);
                addNewObj(url,dataObj);
                $('.img_box').remove();
            })
        }
        if($(this).attr('id') === 'Update'){
            $('#form_vision').append('<input type="hidden" name="current_icon" id="current_icon" value="">'+'<input type="hidden" name="id" id="id" value="">');
            var urlGet = '../about-us/vision/getData';
            $('#id').val($(this).data('status'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'GET',
                url: urlGet,
                data:{
                    'id':$(this).data('status')
                },
                dataType: false,
                cache: false,
                success: function (res) {
                    if (res.success) {
                        console.log(res.success);
                        var d = JSON.parse(res.success.substring(1, res.success.length - 1));
                        console.log(d);
                        $('#id').val(d.id);
                        $('#title_vi').val(d.title_vi);
                        $('#title_en').val(d.title_en);
                        $('.glyphicon-plus-sign').remove();
                        $('.img_box').append('<img src=../../uploads/' + d.icon + ' width="100%" id="img" class="img-responsive" alt>');
                        $('#current_icon').val(d.icon);
                        CKEDITOR.instances['content_vi'].setData(d.content_vi);
                        $('#content_vi').val(d.content_vi);
                        $('#content_en').val(d.content_en);
                        CKEDITOR.instances['content_en'].setData(d.content_en);
                        $('#vision').modal('show');
                        $('#image').on("change", function () {
                            $("#img").attr("src", URL.createObjectURL(this.files[0]));
                        })
                        $('#form_vision').submit(function (e) {
                            e.preventDefault();
                            var dataObj = new FormData($(this)[0]);
                            for (var i of dataObj.entries()) {
                                console.log(i[0] + ' ' + i[1]);
                            }
                            var urlUp = '../about-us/vision/modify';
                            addNewObj(urlUp,dataObj);
                            $('.img_box').append('<span class="glyphicon glyphicon-plus-sign" style="font-size: 150px;left: 25%;top:25%"></span>');
                        })
                        // location.reload();
                    } else {
                        alert('Failed');

                    }
                }
            })

        }
    })
    $('.btnAddTeam').click(function (e) {
        e.preventDefault();
        if ($(this).attr('id') === 'Add') {
            var url = '../about-us/our-team/store';

            $('#our-team').modal('show');
            $('#image').on("change", function () {
                $('.glyphicon-plus-sign').remove();
                $('.img_box').append('<img src=""  id="img"  class="img-responsive" style="width:100%;height:100%">');
                $("#img").attr("src", URL.createObjectURL(this.files[0]));
            })
            $('#form_our_team').submit(function (e) {
                e.preventDefault();
                var dataObj = new FormData($(this)[0]);
                addNewObj(url, dataObj);
                // $('.img_box').remove();
            })
        }
        if($(this).attr('id') === 'Update'){
            $('#form_our_team').append('<input type="hidden" name="current_image" id="current_image" value="">'+'<input type="hidden" name="id" id="id" value="">');
            var urlGet = '../about-us/our-team/getData';
            $('#id').val($(this).data('status'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'GET',
                url: urlGet,
                data:{
                    'id':$(this).data('status')
                },
                dataType: false,
                cache: false,
                success: function (res) {
                    if (res.success) {
                        console.log(res.success);
                        var d = JSON.parse(res.success.substring(1, res.success.length - 1));
                        console.log(d);
                        $('#id').val(d.id);
                        $('#name').val(d.name);
                        $('#roll_vi').val(d.roll_vi);
                        $('#roll_en').val(d.roll_en);
                        $('.glyphicon-plus-sign').remove();
                        $('.img_box').append('<img src=../../uploads/' + d.image + ' id="img" class="img-responsive"'+' style="width:100%;height:100%" '+ 'alt>');
                        $('#current_image').val(d.image);
                        $('#our-team').modal('show');
                        $('#image').on("change", function () {
                            $("#img").attr("src", URL.createObjectURL(this.files[0]));
                        })
                        $('#form_our_team').submit(function (e) {
                            e.preventDefault();
                            var dataObj = new FormData($(this)[0]);
                            for (var i of dataObj.entries()) {
                                console.log(i[0] + ' ' + i[1]);
                            }
                            var urlUp = '../about-us/our-team/modify';
                            addNewObj(urlUp,dataObj);
                            $('.img_box').append('<span class="glyphicon glyphicon-plus-sign" style="font-size: 150px;left: 25%;top:25%"></span>');
                        })
                    } else {
                        alert('Failed');

                    }
                }
            })

        }
    })
    //change status active
    $('#btnActivate').click(function (e) {
        e.preventDefault();
        $(this).toggleClass('btn-danger');
        if ($(this).attr('class') === "btn btn-success btn-danger") {
            $(this).text('Unactive');
            $("#spanActivate").css('color', 'red');
            $('#is_active').val("0");
        }
        else {
            $(this).text('Active');
            $("#spanActivate").css('color', 'green');
            $('#is_active').val("1");
        }
        $("#spanActivate").toggleClass('glyphicon-remove');
    })
    $('.close').click(function (e) {
        e.preventDefault();
        $('.modal').modal('hide');
    })
})