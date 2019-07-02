@extends('admin.changelog.base')
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
                            <button id="btn-add" class="btn btn-success" onclick="document.getElementById('modal-add').style.display='block'" style="width:auto">
                                <i class="fa fa-plus"></i>
                                Add
                            </button>
                        </div>
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="10%">Version</th>
                                    <th>Changelog</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($result as $key => $item)
                                    <tr role="row" class="odd">
                                        <td>{{ $item->version }}</td>
                                        <td>{!! html_entity_decode($item->changelog) !!}</td>
                                        <td>
                                            <button data-url="{{ route('admin.changelog.update', ['id' => $item->id]) }}"​ type="button" onclick="document.getElementById('modal-update').style.display='block'" class="btn btn-success btn-update" style="width:auto">
                                                <i class="fa fa-edit"></i>
                                                Update
                                            </button>
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
        @include('admin.changelog.create')
        @include('admin.changelog.update')
    <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
    </section>
@endsection
