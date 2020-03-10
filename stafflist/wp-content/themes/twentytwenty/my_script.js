jQuery( document ).ready( function($) {

    $(document).on( 'click', '.delete-post', function() {
        var id = $(this).data('id');
        var nonce = $(this).data('nonce');
        var post = $(this).parents('.user:first');
        $.ajax({
             type: 'POST',
             url: 'wp-admin/admin-ajax.php',
            data: {
                action: 'my_delete_post',
                nonce: nonce,
                id: id
            },
            success: function( result ) {
                if( result == 'success' ) {
                    post.fadeOut( function(){
                        post.remove();
                    });
                }
            }
        })
        return false;
    })
})
