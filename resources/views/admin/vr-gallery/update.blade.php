@extends('admin.vr-gallery.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Update VR Info</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.vr-gallery.modify') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="id" value="{{ $model->id }}" />
                            <input type="hidden" name="currentImage" value="{{ $model->image }}" />
                            <input type="hidden" name="updated_by" id="user" value="{{ Auth::user()->name }}" required>
                            <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                                <label for="link" class="col-md-2 control-label">Link</label>

                                <div class="col-md-8">
                                    <input id="link" type="text" class="form-control" name="link" style="width: 100%" value="{{ $model->link }}" required autofocus>

                                    @if ($errors->has('link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
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
                                    <input class="form-control" type="file" id="image" name="image" style="width: 31%">
                                    <p></p>
                                    {{ HTML::image(asset("uploads/" . $model->image),'', array('width' => 100)) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" style="width: 15%">
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