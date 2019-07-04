@extends('admin.download.base')
@section('action-content')
    <div id="update_version" class="modal">
        <form class="modal-content animate" id="add_new">
            <div class="imgcontainer">
                <span onclick="document.getElementById('update_version').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>
            <br>
            <div id="form-errors" style="height: 10%">

            </div>
            <div class="container">
                <input type="hidden" id="operation_system_id" name="operation_system_id">
                <input type="hidden" id="created_by" name="created_by" value="{{$user}}">
                <input type="hidden" id="updated_by" name="updated_by" value="{{$user}}">
                <div class="form-group">
                    <label for="os_name" class="col-md-2 control-label">OS</label>
                    <div class="col-md-8">
                        <p id="os_name"></p>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="version" class="col-md-2 control-label">Version</label>

                    <div class="col-md-8">
                        <input id="version" type="text" class="form-control" name="version" value="" >
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="version_path" class="col-md-2 control-label">Path</label>

                    <div class="col-md-8">
                        <input id="version_path" type="text" class="form-control" name="version_path" value="" >
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="description" class="col-md-2 control-label">Description</label>

                    <div class="col-md-8">
                        <textarea id="description" rows="5" col="60" class="form-control" name="description" value="" ></textarea>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <input id="is_active" type="hidden" class="form-control" name="is_active" value="1">
                </div>
                <br>
                <div class="form-group text-center">
                    <button class="btn btn-success" type="submit" style="width: 20%;margin-top: 3%" >Add</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-13">
        <div class="box" style="border-top:0">
            <br>
            <div class="box box-success">
                <div class="col-sm-13" style="position: relative">
                    <div class= "col-sm-13">
                        <form id="new-os">
                            <div class="form-group" >
                                <div class="col-md-1">
                                    <label for="os_name" class=" control-label">Name</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="os_name" id="os_name" value="" placeholder="OS name" style="width: 60%;float: left" required>
                                    <button class="btn btn-success" type="submit"  style="float: left;margin-left: 20px;width:30%">
                                       <span class="glyphicon glyphicon-plus"></span> Add new OS
                                    </button>
                                </div>
                                <div class="col-md-5" style="margin-top: 0.5em">
                                   <div id="err">

                                   </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-sm-13">
                    <br>
                    <table id="datatable" class="table table-bordered table-hover dataTable" role="grid" >
                        <thead>
                        <tr role="row">
                            <th width="10%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">OS</th>
                            <th width="7%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"  aria-sort="ascending">Version</th>
                            <th width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Path</th>
                            <th width="7%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"  aria-sort="ascending">Created_by</th>
                            <th width="35%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1"  aria-label="Action: activate to sort column ascending">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($li as $key => $item)
                            @foreach($item->versions as $os)
                                @if($os->is_active == 1)
                                    <tr role="row" class="odd">
                                        <td class="text-center">{{$item->os_name}}</td>
                                        <td class="text-center">
                                            {{$os->version}}
                                        </td>
                                        <td class="text-center">{{$os->version_path}}</td>
                                        <td class="text-center">{{$os->created_by}}</td>
                                        <td class="text-center">
                                            <button class="btn btn-google col-sm-4 col-xs-5 btn-margin btnLog"  style="width: 20%;float: right" onclick="document.getElementById('log').style.display='block';" id="{{$item->id}}*{{$item->os_name}}" ><span class="glyphicon glyphicon-list"></span>&nbsp Log</button>
                                            <button  class="btn btn-success col-sm-4 col-xs-5 btn-margin update_ver" id="{{$item->id}}*{{$item->os_name}}" style="width: 20%; float: right" onclick="document.getElementById('update_version').style.display='block'"><span class="glyphicon glyphicon-edit"></span>&nbsp Add New</button>
                                            <div class="col-md-6" style="margin-top: 1.32%;width:40%;" id="{{$item->os_name}}">
                                                <input id="ver_now" type="hidden" class="form-control" name="os_name" value="{{$os->version}}" >
                                                <input id="id_os" type="hidden" class="form-control" name="os_name" value="{{$os->id}}" >
                                                <div class="form-group">
                                                    <div class="col-md-8" style="margin-top: 2%;width:100%">
                                                        <select name="ver_up" class="version_up" id="{{$item->id}}*{{$os->version}}*{{$user}}" data-status="{{$os->version_path}}">
                                                            <option value="select">Version Update</option>
                                                            @foreach($item->versions as $os)
                                                                <option value="{{$os->version}}">{{$os->version}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        @foreach($lin as $li_n)
                            <tr role="row" class="odd">
                                <td class="text-center">{{$li_n->os_name}}</td>
                                <td class="text-center">...</td>
                                <td class="text-center">...</td>
                                <td class="text-center">...</td>
                                <td class="text-center">
                                    <button  class="btn btn-success col-sm-4 col-xs-5 btn-margin update_ver" id="{{$li_n->id}}*{{$li_n->os_name}}" style="width: 20%; float: left;margin-left: 53.5%;" onclick="document.getElementById('update_version').style.display='block'">Add New</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="log" class="modal">
        <div class="modal-content animate">
            <div class="imgcontainer">
                <span onclick="document.getElementById('log').style.display='none'" class="close closeLog" title="Close Modal">&times;</span>
            </div>

            <div class="container">
                <h4></h4>
                <table class="table table-bordered table-hover dataTable" role="grid" >
                    <thead>
                        <tr role="row">
                            <th width="16%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Thời gian thay đổi</th>
                            <th  width="12%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Người thay đổi</th>
                            <th width="10%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"  aria-sort="ascending">Phiên bản cũ</th>
                            <th width="25%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">Link cũ</th>
                            <th width="11%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"  aria-sort="ascending">Phiên bản mới</th>
                            <th width="25%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"  aria-sort="ascending" >Link mới</th>
                        </tr>
                    </thead>
                    <tbody class="logs">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

