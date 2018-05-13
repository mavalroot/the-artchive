function actionButton(action, bigone, refresh) {
    $(bigone).on('submit','form[name="'+action+'"]', function(e) {
        e.preventDefault();
        let that = $(this);
        $.post('usuarios-completo/'+action, $(this).serialize(), function(data) {
            if (data) {
                $(refresh).load(location.href+` ${refresh}>*`,"");
            }
        });
    });
}
