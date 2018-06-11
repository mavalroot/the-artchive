function deleteAccount() {
    $('#delete-account').on('click', function (e) {
        e.preventDefault();
        let w = window.open('/delete-account/index', 'delete','scrollbars=yes,resizable=no,toolbar=no,width=500,height=420,menubar=no');
        w.onload = function () {
            let deleteform = w.document.getElementById('delete-form');
            let boton = $(deleteform).find('button');
            $(boton).on('click', function (e) {
                e.preventDefault();
                $.post('/delete-account/delete', $(deleteform).serialize(), function (data) {
                    if (data != false) {
                        w.opener.location.reload();
                        w.close();
                    }
                });
            });
        };
    });
}
