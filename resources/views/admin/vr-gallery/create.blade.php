<div id="modal-add" class="modal">
    <form class="modal-content animate" id="add-vr" enctype="multipart/form-data">
        <div class="imgcontainer">
            <span onclick="document.getElementById('modal-add').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="modal-header">
            <h4 class="modal-title" align="center">Add new VR</h4>
        </div>
        <div class="modal-body" style="width: 30%">
            <span id="form-result"></span>
            <div class="form-group">
                <input type="hidden" name="created_by" id="user" value="{{ Auth::user()->name }}" required>
                <label for="link"><b>Link</b></label>
                <br>
                <div class="col-md-8" style="width: 650%">
                    <input type="text" placeholder="Enter link" name="link" id="link-add" value="" required />
                </div>
            </div>
            <div class="form-group">
                <label for="image"><b>Image</b></label>
                <br>
                <div class="col-md-8" style="padding: 12px 20px">
                    <div class="form-control" style="width: 300%;">
                        <input type="file" name="image" id="image-add" value="" required>
                    </div>
                    <span id="store_image"></span>
                </div>
            </div>
            <div class="form-group">
{{--                <label for="is_active">Enable?</label>--}}
                <div class="col-md-8" style="margin-left: 155%">
                    <a class="btn btn-success" id="btn-add-activate" style="width: 80px">Enabled</a>
                    <input type="hidden" id="is_active-add" name="is_active" class="form-control" value="1">
                    <button type="button"  name="btn-submit" id="btn-submit" class="btn btn-primary" style="width: 80px">Submit</button>

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </form>
</div>