@extends('admin.about-us.vision.base')
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
                            <button  class="btn btn-success btnAddVision" id="Add" >Add new</button>
                            <button  class="btn btn-primary" >View</button>
                        </div>
                        <div id="vision" class="modal">
                            <form class="modal-content animate" id="form_vision" enctype="multipart/form-data" data-url="" >
                                <div class="imgcontainer">
                                    <span class="close" title="Close Modal">&times;</span>
                                </div>
                                <br>
                                <br>
                                <div class="container">
                                    <input type="hidden" id="updated_by" name="updated_by" class="form-control" value="{{$current_user}}" >
                                    <input type="hidden" id="created_by" name="created_by" class="form-control" value="{{$current_user}}" >
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
                                        <label for="icon" class="col-md-2 control-label">Icon</label>
                                        <div class="col-md-8">
                                            <div class="col-md-4 img_box" style="width: 100px;height:100px">
                                                <span class="glyphicon glyphicon-plus-sign" style="font-size: 50px;left: 25%;top:25%"></span>
                                            </div>
                                            <input id="icon" type="file" name="icon" value="" style="opacity: 0;position: absolute;left:5px;top:0;font-size: 100px;width:100px;height:100px">
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
                                    <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Icon</th>
                                    <th width="15%" class="text-center hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Status</th>
                                    <th width="10%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Sort</th>
                                    <th class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($visions as $key =>$vision)
                                    <tr role="row" class="odd">
                                        <td class="text-center">{{$vision->title_vi}}</td>
                                        <td class="text-center">{{$vision->title_en}}</td>
                                        <td class="text-center">{{ HTML::image(asset("uploads/" . $vision->icon),'', array('width' => 200)) }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);"
                                               data-token="{{ csrf_token() }}"
                                               data-id="{{ $vision->id }}"
                                               data-status="{{ $vision->is_active }}"
                                               data-url="{{ route('admin.about-us.vision.activate') }}"
                                               class="btnActivate">
                                                <span class="glyphicon {{ ($vision->is_active != 0) ? 'glyphicon-ok text-green' : 'glyphicon-remove text-red' }}"></span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <input id="sort" type="number" class="form-control inputSort" name="sort" value="{{ $vision->sort }}"
                                                   data-token="{{ csrf_token() }}" data-id="{{ $vision->id }}" data-url="{{route('admin.about-us.vision.sort')}}" autofocus>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-success col-sm-4 col-xs-5 btn-margin btnAddVision"  style="width: 25%;"  id="Update" data-status="{{ $vision->id }}" >Update</button>
                                            <button  class="btn btn-google col-sm-4 col-xs-5 btn-margin btnRemove" data-id="{{ $vision->id }}" data-url="{{route('admin.about-us.vision.remove')}}"  data-token="{{ csrf_token() }}" style="width: 25%;" onclick="">Delete</button>
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