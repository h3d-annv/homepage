@extends('admin.vr-gallery.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-13">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title text-bold">Listing</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-12">
                            <button id="btn-add" class="btn btn-success" onclick="document.getElementById('modal-add').style.display='block'" style="width:auto; margin-bottom: 7px">Add new</button>
                            <a href="{{ route('vr-gallery.index') }}" class="btn btn-primary" role="button" target="_blank">View</a>
                        </div>
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="10%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Image</th>
                                    <th width="35%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Link</th>
                                    <th width="15%" class="text-center hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Status</th>
                                    <th width="10%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Sort</th>
                                    <th class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($result as $key => $item)
                                    <tr role="row" class="odd">
                                        <td align="center">{{ HTML::image(asset("uploads/" . $item->image),'', array('width' => 200)) }}</td>
                                        <td align="center"><a href="{{ $item->link }}" style="color: #007bff;" target="_blank">{{ $item->link }}</a></td>
                                        <td align="center">
                                            <a href="javascript:void(0);"
                                               data-token="{{csrf_token()}}"
                                               data-id="{{ $item->id }}"
                                               data-status="{{ $item->is_active }}"
                                               data-url="{{ route('admin.vr-gallery.activate') }}"
                                               class="btnActivate">
                                                <span class="glyphicon {{ ($item->is_active != 0) ? 'glyphicon-ok text-green' : 'glyphicon-remove text-red' }}"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <input id="sort" type="number" class="form-control inputSort" name="sort" min="1" value="{{ $item->sort }}"
                                                 data-token="{{csrf_token()}}"  data-id="{{ $item->id }}" data-url="{{ route('admin.vr-gallery.sort') }}" autofocus>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.vr-gallery.update', ['id' => $item->id]) }}" class="btn btn-success col-sm-3 col-xs-5" style="margin-right:5%;width:47%;">
                                                Update
                                            </a>
                                            <a data-id="{{ $item->id }}" data-url="{{ route('admin.vr-gallery.remove') }}" class="btnRemove btn btn-danger col-sm-3 col-xs-5" style="float:right;width:47%;">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $result->appends(Request::get('page'))->links()}}
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

        </div>
        @include('admin.vr-gallery.create')

    <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
@endsection