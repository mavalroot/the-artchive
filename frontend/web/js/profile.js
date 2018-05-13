function follow(name) {
    $('#follow-actions').on('submit','form[name="'+name+'"]', function(e) {
        e.preventDefault();
        let that = $(this);
        $.post('usuarios-completo/'+name, $(this).serialize(), function(data) {
            if (data) {
                $("#follow-actions").load(location.href+" #follow-actions>*","");
            }
        });
    });
}

function block(name) {
    $('.usuarios-completo-view').on('submit','#block-actions form[name="'+name+'"]', function(e) {
        e.preventDefault();
        let that = $(this);
        $.post('usuarios-completo/'+name, $(this).serialize(), function(data) {
            if (data) {
                $(".usuarios-completo-view").load(location.href+" .usuarios-completo-view>*","");
            }
        });
    });
}
