var ProductCategory = {
    init: function () {
        // Remove item
        $('.btnRemove').click(function(){
            var id = $(this).data('id');
            var url = $(this).data('url');
            var _token = $(this).data('token');

            if(confirm('Do you really want to delete this item?')){
                ProductCategory.remove(id, url, _token)
            }
        });

        $('.btnActivate').click(function(){
            var id = $(this).data('id');
            var status = $(this).data('status');
            var url = $(this).data('url');
            var _token = $(this).data('token');

            var changeToStatusText = (status == 1) ? 'deactive' : 'active';

            if(confirm('Do you really want to ' + changeToStatusText + ' this item?')){
                ProductCategory.updateStatus(id, url, _token, status)
            }
        });
    },

    remove: function(id, url, _token){
        $.ajax({
            method: 'DELETE',
            url: url,
            data: {
                id: id,
                _token: _token,
            },
            success: function(res){
                if(res === 'Deleted'){
                    alert('Done');
                }else{
                    alert('Failed');
                }
                window.location.reload();
            }
        });
    },

    updateStatus: function(id, url, _token, status){
        $.ajax({
            method: 'PUT',
            url: url,
            data: {
                id: id,
                status: status,
                _token: _token,
            },
            success: function(res){
                console.log(res);
                if(res === 'Done'){
                    alert('Done');
                }else{
                    alert('Failed');
                }
                window.location.reload();
            }
        });
    }
}
