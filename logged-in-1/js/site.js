jQuery(document).ready(function(){
    jQuery(document).foundation();
    window.get_user_app()
})

window.get_user_app = () => {
    jQuery.ajax({
        type: "POST",
        data: JSON.stringify({ action: 'something', parts: jsObject.parts }),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: jsObject.root + jsObject.parts.root + '/v1/' + jsObject.parts.type,
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-WP-Nonce', jsObject.nonce )
        }
    })
        .done(function(data){
            console.log( data )
            jQuery('#api-check').html(`&#9989;`)
        })
        .fail(function(e) {
            console.log(e)
            jQuery('#error').html(e)
        })
}