function actionButton(action, name, bigone, refresh) {
    $(bigone).on('submit','form[name="'+name+'"]', function(e) {
        e.preventDefault();
        let that = $(this);
        $.post(action, $(this).serialize(), function(data) {
            if (data) {
                $(refresh).load(location.href+` ${refresh}>*`,"");
            }
        });
    });
}
