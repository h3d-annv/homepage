@extends('admin.product.base')
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
                            <form action="{{ route('admin.product.index') }}" method="get">
                                @csrf
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="title" value="{{ $title }}">
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
                            <a href="{{ route('admin.product.create') }}" class="btn btn-success" role="button">Add new</a>
                        </div>
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="10%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Image</th>
                                    <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Vietnamese name</th>
                                    <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">English name</th>
                                    <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Category</th>
                                    <th width="10%" class="text-center hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Status</th>
                                    <th width="10%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Sort</th>
                                    <th class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($result as $key => $item)
                                    <tr role="row" class="odd">
                                        <td>{{ HTML::image(asset("uploads/" . $item->image),'', array('width' => 200)) }}</td>
                                        <td align="center">{{ $item->title_vi }}</td>
                                        <td align="center">{{ $item->title_en }}</td>
                                        @foreach($categories as $category)
                                            @if($category->id == $item->category_id)
                                            <td align="center">{{ $category->title_en }}</td>
                                            @endif
                                        @endforeach
                                        <td align="center">
                                            <a href="javascript:void(0);"
                                               data-token="{{ csrf_token() }}"
                                               data-id="{{ $item->id }}"
                                               data-status="{{ $item->is_active }}"
                                               data-url="{{ route('admin.product.activate') }}"
                                               class="btnActivate">
                                                <span class="glyphicon {{ ($item->is_active != 0) ? 'glyphicon-ok text-green' : 'glyphicon-remove text-red' }}"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <input id="sort" type="number" class="form-control inputSort" name="sort" value="{{ $item->sort }}"
                                                   data-token="{{ csrf_token() }}" data-id="{{ $item->id }}" data-url="{{ route('admin.product.sort') }}" autofocus>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.product.update', ['id' => $item->id]) }}" class="btn btn-success col-sm-6 col-xs-5" style="margin-right: 10%;padding: 5px;font-size: 14px;width:45%;">
                                                Update
                                            </a>
                                            <a data-token="{{ csrf_token() }}" data-id="{{ $item->id }}" data-url="{{ route('admin.product.remove') }}" class="btnRemove btn btn-danger col-sm-6 col-xs-5" style="padding: 5px;font-size: 14px;width:45%">
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