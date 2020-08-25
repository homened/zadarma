<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/header.tpl');
?>
<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/header_panel.tpl', $vars);
?>
<main role="main" class="container pt-5">
   <div class="my-3 p-3 bg-white rounded shadow-sm">
      <h6 class="border-bottom border-gray pb-2 mb-0">Контакт</h6>
      <table>
        <tr>
            <th>Имя:</th>
            <td><?php print $vars['contact']['firstname']; ?></td>
        </tr>
        <tr>
            <th>Фамилия:</th>
            <td><?php print $vars['contact']['lastname']; ?></td>
        </tr>
        <tr>
            <th>Телефон:</th>
            <td><?php print $vars['contact']['phone']; ?> (<?php print $this->core->libraries->str->number2string($vars['contact']['phone']); ?>)</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?php print $vars['contact']['email']; ?></td>
        </tr>
        <tr>
            <th>Фото:</th>
            <td><img width="80" src=".<?php print $vars['contact']['src-photo']; ?>"></td>
        </tr>
      </table>
   </div>
</main>

<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/footer.tpl');
?>