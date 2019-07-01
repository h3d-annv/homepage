@extends('admin.about-us.intro.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-13">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title text-bold">Search</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="title" value="">
                                        <span class="input-group-btn">
                                            <input type="submit" class="btn btn-block btn-success" value="Search">
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title text-bold">Listing</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-12">
                            <button  class="btn btn-success btnAddIntro" id="Add" >Add new</button>
                            <button  class="btn btn-primary" >View</button>
                        </div>
                        {{--form intro--}}
                        <div id="intro" class="modal">
                            <form class="modal-content animate" id="form_intro" enctype="multipart/form-data" data-url="" >
                                <div class="imgcontainer">
                                    <span class="close" title="Close Modal">&times;</span>
                                </div>
                                <br>
                                <br>
                                <div class="container">
                                    <input type="hidden" id="updated_by" name="updated_by" class="form-control" value="{{$current_user}}" >
                                    {{--<input type="hidden" name="current_image" id="current_image" value="">--}}
                                    <input type="hidden" id="created_by" name="created_by" class="form-control" value="{{$current_user}}" >
                                    {{--<input type="hidden" name="id" id="id" value="">--}}
                                    <div class="form-group">
                                        <label for="title_vi" class="col-md-2 control-label">Vietnamese Title</label>
                                        <div class="col-md-8">
                                            <input id="title_vi" type="text" class="form-control" name="title_vi" value="" required>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label for="title_en" class="col-md-2 control-label">English Title</label>
                                        <div class="col-md-8">
                                            <input id="title_en" type="text" class="form-control" name="title_en" value="" required >
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-md-8" style="margin-left: 16.5%;">
                                            <a class="btn btn-success" id="btnActivate" >Active</a>
                                            <span class="glyphicon glyphicon-ok" style="color:green" id="spanActivate"></span>
                                            <input type="hidden" id="is_active" name="is_active" class="form-control" value="1">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label for="image" class="col-md-2 control-label">Image</label>
                                        <div class="col-md-8" style="position: relative;overflow: hidden;display: inline-block;">
                                            <div class="col-md-4 img_box">
                                                <span class="glyphicon glyphicon-plus-sign" style="font-size: 150px;left: 25%;top:25%"></span>
                                            </div>
                                            <input id="image" type="file" name="image" value="" style="opacity: 0;position: absolute;left:0;top:0;font-size: 300px;width:300px;height:300px">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group" >
                                        <div class="col-md-12" style="padding-left: 0">
                                            <label for="content_vi" class="col-md-2 control-label">Vietnamese Content</label>
                                            <div class="col-md-8" style="margin-left: 1%;width:71%;">
                                                <textarea id="content_vi" type="text" class="form-control" name="content_vi" ></textarea>
                                                <script>
                                                    CKEDITOR.replace( 'content_vi' );
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" >
                                        <div class="col-md-12" style="padding-left: 0;margin-top: 2%;">
                                            <label for="content_en" class="col-md-2 control-label">English Content</label>
                                            <div class="col-md-8" style="margin-left: 1%;width:71%;">
                                                <textarea id="content_en" type="text" class="form-control" name="content_en" ></textarea>
                                                <script>
                                                    CKEDITOR.replace( 'content_en' );
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group text-center">
                                        <button class="btn btn-success" type="submit" style="width: 20%;margin-top: 3%" >Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12">
                            <table id="introTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Vietnamese Title</th>
                                        <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">English Title</th>
                                        <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Image</th>
                                        <th width="15%" class="text-center hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Status</th>
                                        <th width="10%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Sort</th>
                                        <th class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($intros as $key =>$intro)
                                        <tr role="row" class="odd">
                                            <td class="text-center">{{$intro->title_vi}}</td>
                                            <td class="text-center">{{$intro->title_en}}</td>
                                            <td class="text-center">{{ HTML::image(asset("uploads/" . $intro->image),'', array('width' => 200)) }}</td>
                                            <td class="text-center">
                                                <a href="javascript:void(0);"
                                                   data-token="{{ csrf_token() }}"
                                                   data-id="{{ $intro->id }}"
                                                   data-status="{{ $intro->is_active }}"
                                                   data-url="{{ route('admin.about-us.intro.activate') }}"
                                                   class="btnActivate">
                                                    <span class="glyphicon {{ ($intro->is_active != 0) ? 'glyphicon-ok text-green' : 'glyphicon-remove text-red' }}"></span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <input id="sort" type="number" class="form-control inputSort" name="sort" value="{{ $intro->sort }}"
                                                       data-token="{{ csrf_token() }}" data-id="{{ $intro->id }}" data-url="{{ route('admin.about-us.intro.sort') }}" autofocus>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-success col-sm-4 col-xs-5 btn-margin btnAddIntro"  style="width: 25%;"  id="Update" data-status="{{ $intro->id }}" >Update</button>
                                                <button  class="btn btn-google col-sm-4 col-xs-5 btn-margin btnRemove" data-id="{{ $intro->id }}" data-url="{{ route('admin.about-us.intro.remove') }}"  data-token="{{ csrf_token() }}" style="width: 25%;" onclick="">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>

@endsection