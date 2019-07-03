@extends('admin.product.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Update Product Info</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.product.modify') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="id" value="{{ $model->id }}" />
                            <input type="hidden" name="currentImage" value="{{ $model->image }}" />
                            <input type="hidden" name="currentSlug" value="{{ $model->slug }}" />
                            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <label for="category_id" class="col-md-2 control-label">Category</label>
                                <div class="col-md-8" id="cate">
                                    <select name="category_id" class="form-control" value="{{old('category_id')}}" required>
                                        <option {{ old('category_id') ? "" : "selected" }} disabled>{{ $current_category }} (No change)</option>
                                        <option value="" disabled>------</option>
                                        @foreach($categories as $category)
                                            <option {{old('category_id') == $category->id ? $selected : ""}} value="{{$category->id}}">{{$category->title_en}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('title_vi') ? ' has-error' : '' }}">
                                <label for="title_vi" class="col-md-2 control-label">Vietnamese Title</label>

                                <div class="col-md-8">
                                    <input id="title_vi" type="text" class="form-control" name="title_vi" value="{{ $model->title_vi }}" required autofocus>

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
                                    <input id="title_en" type="text" class="form-control" name="title_en" value="{{ $model->title_en }}" required autofocus>

                                    @if ($errors->has('title_en'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title_en') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
                                <label style="padding-top: 0 !important;" for="is_active" class="col-md-2 control-label">Enable?</label>

                                <div class="col-md-8">
                                    <input id="is_active" type="checkbox" class="minimal" name="is_active" value="1"
                                           @if($model->is_active == 1)
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
                            <div class="form-group{{ $errors->has('content_vi') ? ' has-error' : '' }}">
                                <label for="content_vi" class="col-md-2 control-label">Vietnamese Content</label>
                                <div class="col-md-8">
                                    <textarea id="description_vi" rows="10" class="form-control" name="content_vi" value="{{ old('content_vi') }}" required autofocus>{{ $model->content_vi }}</textarea>

                                    @if ($errors->has('content_vi'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content_vi') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('content_en') ? ' has-error' : '' }}">
                                <label for="content_en" class="col-md-2 control-label">English Content</label>
                                <div class="col-md-8">
                                    <textarea id="description_en" rows="10" class="form-control" name="content_en" value="{{ old('content_en') }}" required autofocus>{{ $model->content_en }}</textarea>

                                    @if ($errors->has('content_en'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content_en') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" id="submit">
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
<script>
    $(document).ready(function() {
        const categoryOldValue = '{{ old('category_id') }}';

        if(categoryOldValue !== '') {
            $('#cate').val(categoryOldValue);
        }
    });
</script>