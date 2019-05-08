@extends('admin.product-category.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title text-bold">Search section</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form action="{{ route('admin.product-category.index') }}" method="get">
                                @csrf
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="search string here ..." name="title" value="{{ $title }}">
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
                        <h3 class="box-title text-bold">Listing section</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-12">
                            <a href="{{ route('admin.product-category.create') }}" class="btn btn-success" role="button">Add new</a>
                        </div>
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="10%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Image</th>
                                    <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Vietnamese name</th>
                                    <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">English name</th>
                                    <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Slug</th>
                                    <th width="10%" class="text-center hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Status</th>
                                    <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Sort</th>
                                    <th class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($result as $key => $item)
                                    <tr role="row" class="odd">
                                        <td>{{ HTML::image(asset("uploads/" . $item->image),'', array('width' => 200)) }}</td>
                                        <td>{{ $item->title_vi }}</td>
                                        <td>{{ $item->title_en }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>
                                            <a href="javascript:void(0);"
                                               data-token="{{ csrf_token() }}"
                                               data-id="{{ $item->id }}"
                                               data-status="{{ $item->is_active }}"
                                               data-url="{{ route('admin.product-category.activate') }}"
                                               class="btnActivate">
                                                <span class="glyphicon {{ ($item->is_active != 0) ? 'glyphicon-ok text-green' : 'glyphicon-remove text-red' }}"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <input id="sort" type="number" class="form-control inputSort" name="sort" value="{{ $item->sort }}"
                                                   data-token="{{ csrf_token() }}" data-id="{{ $item->id }}" data-url="{{ route('admin.product-category.sort') }}" autofocus>
                                        </td>
                                        <td class="">
                                            <a href="{{ route('admin.product-category.update', ['id' => $item->id]) }}" class="btn btn-success col-sm-3 col-xs-5 btn-margin">
                                                Update
                                            </a>
                                            <a data-token="{{ csrf_token() }}" data-id="{{ $item->id }}" data-url="{{ route('admin.product-category.remove') }}" class="btnRemove btn btn-danger col-sm-3 col-xs-5 btn-margin">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                @if(count($result) > 0)
                                    <tfoot>
                                    <tr>
                                        <th width="10%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Image</th>
                                        <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Vietnamese name</th>
                                        <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">English name</th>
                                        <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Slug</th>
                                        <th width="10%" class="text-center hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Status</th>
                                        <th class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Actions</th>
                                    </tr>
                                    </tfoot>
                                @endif
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
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
    <script>
        $('#btnRemove').on('click', function(){
            // var id = $(this).data('id');
            // var url = $(this).data('url');
            alert(1);
        });
    </script>
@endsection