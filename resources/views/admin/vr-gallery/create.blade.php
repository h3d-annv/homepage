<div class="modal" id="modal-add">
    <form class="modal-content animate" id="add-vr" enctype="multipart/form-data" style="margin-top: -5px; margin-left: 400px; width: 80%; max-width:800px; height: 100%; max-height: 350px" >
        <div class="img-container">
            <span onclick="document.getElementById('modal-add').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container">
            <h3 class="modal-title">Add VR</h3>
            <br>
            <span id="form-result"></span>
            <input type="hidden" name="created_by" id="user" value="{{ Auth::user()->name }}" required>
            <div class="form-group">
                <label for="link"><b>Link</b></label>
                <br>
                <div class="col-md-13" style="width: 129%">
                    <input type="text" name="version" id="link-add" value="" required />
                </div>
            </div>
            <div class="form-group">
                <label for="image"><b>Image</b></label>
                <br>
                <div class="col-md-13" style="width: 64%">
                    <div class="form-control">
                        <input type="file" name="image" id="image-add" value="" required>
                    </div>
                    <span id="store_image"></span>
                </div>
            </div>
            <div class="form-group">
                <br>
                <br>
                <div class="col-md-13" style="margin-left: 28%">
                    <a class="btn btn-success" id="btn-add-activate" style="width: 80px">Enabled</a>
                    <input type="hidden" id="is_active-add" name="is_active" class="form-control" value="1">
                    {{--                    <button type="button"  name="btn-submit" id="btn-submit" class="btn btn-primary" style="width: 80px">Submit</button>--}}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-13" style="margin-left: 42%">
                <button type="button"  name="btn-submit" id="btn-submit" class="btn btn-primary" style="width: 80px">Submit</button>
            </div>
        </div>
    </form>
</div>
