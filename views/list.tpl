<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/header.tpl');
?>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
   <a class="navbar-brand mr-auto mr-lg-0" href="#">Zadarma</a>
   <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
   <span class="navbar-toggler-icon"></span>
   </button>
   <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
    
      </ul>
      <span class="text-white">Добро пожаловать, <?php print $vars['user']['login']; ?></span>
      <a href="./?controller=logout"><button class="btn text-white my-2 my-sm-0" type="submit">Выйти</button></a>
   </div>
</nav>
<main role="main" class="container pt-5">
   <div class="my-3 p-3 bg-white rounded shadow-sm">
      <h6 class="border-bottom border-gray pb-2 mb-0">Телефонная книга</h6>
      <small class="d-block text-right mt-3">
        <a href="#">Добавить контакт</a>
      </small>
      <table id="dtOrderExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="th-sm">Имя
                </th>
                <th class="th-sm">Фамилия
                </th>
                <th class="th-sm">Телефон
                </th>
                <th class="th-sm">Email
                </th>
                <th class="th-sm">Фото
                </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
   </div>
</main>
<script>
$(document).ready(function () {
    $('#dtOrderExample').DataTable({
        "order": [[ 3, "desc" ]],
        "ajax": './?controller=phonebook',
        "language": {
            "url": "./lang/DataTables.russian.json"
        },
        "columnDefs" : [{
            "targets" : 4,
            "data": "img",
            "render" : function ( url, type, full) {
                return '<img height="50px" width="50px" src=".'+full[4]+'"/>';
            }
        }]
    });
    $('.dataTables_length').addClass('bs-select');
});
</script>
<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/footer.tpl');
?>