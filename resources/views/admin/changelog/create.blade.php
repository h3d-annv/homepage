<div class="modal" id="modal-add">
    <form class="modal-content animate" id="add-changelog" enctype="multipart/form-data" style="margin-top: -5px; margin-left: 400px; width: 80%; max-width:800px; height: 100%; max-height: 560px" >
        <div class="img-container">
            <span onclick="document.getElementById('modal-add').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container">
            <h3 class="modal-title">Add Changelog</h3>
            <br>
            <span id="form-result"></span>
            <input type="hidden" name="created_by" id="user" value="{{ Auth::user()->name }}" required>
            <div class="form-group">
                <label for="version" class="col-md-13 control-label"><b>Version</b></label>
                <br>
                <div class="col-md-13" style="width: 129%">
                    <input type="text" name="version" id="version-add" value="" required />
                </div>
            </div>
            <div class="form-group">
                <label for="changelog" class="col-md-13 control-label"><b>Changelog</b></label>
                <br>
                <div class="col-md-8">
                    <textarea id="changelog-add" type="text" class="form-control" name="changelog" ></textarea>
                    <script>
                        CKEDITOR.replace( 'changelog-add' );
                    </script>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-13" style="margin-left: 42%">
                <button type="submit"  name="btn-submit" id="btn-submit" class="btn btn-primary" style="width: 80px">Submit</button>
            </div>
        </div>
    </form>
</div>
