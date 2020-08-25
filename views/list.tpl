<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/header.tpl');
?>
<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/header_panel.tpl', $vars);
?>
<main role="main" class="container pt-5">
   <div class="my-3 p-3 bg-white rounded shadow-sm">
      <h6 class="border-bottom border-gray pb-2 mb-0">Телефонная книга</h6>
      <small class="d-block text-right mt-3">
        <a data-toggle="modal" data-target="#addContactModal" href="#">Добавить контакт</a>
      </small>
      <table id="listContacts" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="th-sm">Имя</th>
                <th class="th-sm">Фамилия</th>
                <th class="th-sm">Телефон</th>
                <th class="th-sm">Email</th>
                <th class="th-sm">Фото</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
   </div>
</main>
<script>
    class listContacts {
        constructor() {
            let D_listContacts = $('#listContacts');
            this.contactsDataTable = D_listContacts.DataTable({
                'order': [[ 3, 'desc' ]],
                'ajax': './?controller=phonebook',
                'language': {
                    'url': './lang/DataTables.russian.json'
                },
                'columnDefs' : [
                    {
                        'targets' : 4,
                        'data': 'img',
                        'render' : function ( url, type, full) {
                            return '<img height="50px" width="50px" src=".' + full[4] + '"/>';
                        }
                    },
                    {
                        'targets' : 5,
                        'data': 'img',
                        'render' : function ( url, type, full) {
                            return '<a href="#" data-id="' + full[5] + '" class="edit_contact">Редактировать</a> / <a href="#" data-id="' + full[5] + '" class="show_contact">Посмотреть</a>';
                        }
                    }
                ]
            });
            $(document).on('click', '.show_contact', e => {
                const id = $(e.target).data('id');
                document.location = './?controller=detail&id=' + id;
                e.preventDefault()
            });
        }
        reload() {
            this.contactsDataTable.ajax.reload();
        }
    }
    class formAddContact {
        constructor(_listContacts) {
            let D_formAddContact = $('#formAddContact'),
                D_addContactModal = $('#addContactModal'),
                D_inputPhoto = $('#inputPhoto'),
                D_inputsFormAddContact = D_formAddContact.find('input, textarea, button');
            D_formAddContact.on('submit', e => {
                $.ajax({
                    type: 'POST',
                    url: './?controller=phonebook',
                    data: new FormData(e.target),
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: () => {
                        D_inputsFormAddContact.attr('disabled', 'disabled');
                    },
                    success: res => {
                        if(res.errors.length === 0) {
                            _listContacts.reload();
                            D_addContactModal.modal('hide');
                            D_formAddContact.find('input, textarea').val('');
                        } else {
                            alert(res.errors.join('; '));
                        }
                        D_inputsFormAddContact.removeAttr('disabled');
                    },
                    error: () => {
                        alert('Ошибка добавления контакта, повторите попытку позже');
                        D_inputsFormAddContact.removeAttr('disabled');
                    }
                });
                e.preventDefault()
            });
            D_inputPhoto.on('change', e => {
                if(e.target.files[0].size > 2 * 1024 * 1024) {
                    alert('Размер изображения больше 2 мб.');
                    D_inputPhoto.val('');
                }
            });
        }
    }
    class formEditContact {
        constructor(_listContacts) {
            let D_formEditContact = $('#formEditContact'),
                D_editContactModal = $('#editContactModal'),
                D_inputPhoto = $('#inputPhotoEdit'),
                D_inputsFormEditContact = D_formEditContact.find('input, textarea, button');
            D_formEditContact.on('submit', e => {
                $.ajax({
                    type: 'POST',
                    url: './?controller=phonebook',
                    data: new FormData(e.target),
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: () => {
                        D_inputsFormEditContact.attr('disabled', 'disabled');
                    },
                    success: res => {
                        if(res.errors.length === 0) {
                            _listContacts.reload();
                            D_editContactModal.modal('hide');
                            D_formEditContact.find('input, textarea').val('');
                        } else {
                            alert(res.errors.join('; '));
                        }
                        D_inputsFormEditContact.removeAttr('disabled');
                    },
                    error: () => {
                        alert('Ошибка редактирования контакта, повторите попытку позже');
                        D_inputsFormEditContact.removeAttr('disabled');
                    }
                });
                e.preventDefault()
            });
            D_inputPhoto.on('change', e => {
                if(e.target.files[0].size > 2 * 1024 * 1024) {
                    alert('Размер изображения больше 2 мб.');
                    D_inputPhoto.val('');
                }
            });
            $(document).on('click', '.edit_contact', e => {
                const id = $(e.target).data('id');
                $('#inputIDEdit').val(id);
                $.ajax({
                    type: 'GET',
                    url: './?controller=phonebook',
                    dataType: 'JSON',
                    data: {
                        id: id
                    },
                    beforeSend: () => {
                        D_inputsFormEditContact.attr('disabled', 'disabled');
                    },
                    success: res => {
                        const row = res.row;
                        $('#inputFirstnameEdit').val(row.firstname);
                        $('#inputLastnameEdit').val(row.lastname);
                        $('#inputPhoneEdit').val(row.phone);
                        $('#inputEmailEdit').val(row.email);
                        D_inputsFormEditContact.removeAttr('disabled');
                    },
                    error: () => {
                        alert('Ошибка редактирования контакта, повторите попытке позже');
                    }
                });
                D_editContactModal.modal('show');
                e.preventDefault()
            });
        }
    }
    (() => {
        const _listContacts = new listContacts();
        const _formAddContact = new formAddContact(_listContacts);
        const _editAddContact = new formEditContact(_listContacts);
    })();
</script>
<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/footer.tpl');
?>