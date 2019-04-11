@extends('admin.product-category.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new Category</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.product-category.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{--<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">--}}
                                {{--<label for="type" class="col-md-4 control-label">Loại sản phẩm</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<select name="kind_id"  class="form-control kind" required >--}}
                                        {{--<option class="kind_option" value="">-------------------Chọn loại sản phẩm trước -------------------</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">--}}
                                {{--<label for="type" class="col-md-4 control-label">Thương hiệu sản phẩm</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<select name="trademark_id"  class="form-control trademark" required>--}}
                                        {{--<option class="trademark_option" value="">-------------------Chọn loại sản phẩm trước -------------------</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group{{ $errors->has('title_vi') ? ' has-error' : '' }}">
                                <label for="title_vi" class="col-md-2 control-label">Vietnamese Title</label>

                                <div class="col-md-8">
                                    <input id="title_vi" type="text" class="form-control" name="title_vi" value="{{ old('title_vi') }}" required autofocus>

                                    @if ($errors->has('title_vi'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title_vi') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                                <label for="title_en" class="col-md-2 control-label">English Title</label>

                                <div class="col-md-8">
                                    <input id="title_en" type="text" class="form-control" name="title_en" value="{{ old('title_en') }}" required autofocus>

                                    @if ($errors->has('title_en'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title_en') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                <label for="slug" class="col-md-2 control-label">Slug</label>

                                <div class="col-md-8">
                                    <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}" required readonly>

                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
                                <label style="padding-top: 0 !important;" for="is_active" class="col-md-2 control-label">Enable?</label>

                                <div class="col-md-8">
                                    <input id="is_active" type="checkbox" class="minimal" name="is_active" value="1" checked
                                           @if(old('is_active') == 1)
                                           checked
                                            @endif
                                    >
                                    @if ($errors->has('is_active'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_active') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-md-2 control-label" >Image</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="file" id="image" name="image" >
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description_vi') ? ' has-error' : '' }}">
                                <label for="description_vi" class="col-md-2 control-label">Vietnamese Description</label>

                                <div class="col-md-8">
                                    <textarea id="description_vi" rows="10" class="form-control" name="description_vi" value="{{ old('description_vi') }}" autofocus></textarea>

                                    @if ($errors->has('description_vi'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description_vi') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description_en') ? ' has-error' : '' }}">
                                <label for="description_en" class="col-md-2 control-label">English Description</label>

                                <div class="col-md-8">
                                    <textarea id="description_en" rows="10" class="form-control" name="description_en" value="{{ old('description_en') }}" required autofocus></textarea>

                                    @if ($errors->has('description_en'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description_en') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
