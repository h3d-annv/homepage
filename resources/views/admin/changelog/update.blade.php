<div class="modal" id="modal-update">
    <form class="modal-content animate" id="update-changelog" enctype="multipart/form-data" style="margin-top: -5px; margin-left: 400px; width: 80%; max-width:800px; height: 100%; max-height: 560px" >
        <div class="img-container">
            <span onclick="document.getElementById('modal-update').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container">
            <h3 class="modal-title">Update Changelog</h3>
            <br>
            <span id="form-result"></span>
            <input type="hidden" name="id" id="id" value="" />
            <input type="hidden" name="updated_by" id="user" value="{{ Auth::user()->name }}" required>
            <div class="form-group">
                <label for="version" class="col-md-13 control-label"><b>Version</b></label>
                <br>
                <div class="col-md-13" style="width: 129%">
                    <input type="text" name="version" id="version-update" value="" required />
                </div>
            </div>
            <div class="form-group">
                <label for="changelog" class="col-md-13 control-label"><b>Changelog</b></label>
                <br>
                <div class="col-md-8">
                    <textarea id="changelog-update" type="text" class="form-control" name="changelog" ></textarea>
                    <script>
                        CKEDITOR.replace( 'changelog-update' );
                    </script>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-13" style="margin-left: 42%">
                <button type="submit"  name="btn-submit" id="btn-submit-update" class="btn btn-primary" style="width: 80px">Submit</button>
            </div>
        </div>
    </form>
</div>
