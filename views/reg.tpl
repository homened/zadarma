<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/header.tpl');
?>
    <div class="d-flex justify-content-center">
        <form method="post" class="form-signin col-md-6 pt-3">
            <?php if(count($vars['errors']) > 0): ?>
                <div class="alert alert-danger" role="alert"><?php print implode(';', $vars['errors']) ?></div>
            <?php endif; ?>
            <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
            <label for="inputLogin">Логин</label>
            <input type="text" id="inputLogin" name="log" class="form-control" required autofocus value="<?php print isset($_POST['log'])? htmlspecialchars($_POST['log']): ''; ?>">
            <label for="inputPassword">Пароль</label>
            <input type="password" id="inputPassword" name="pass" class="form-control" required>
            <label for="inputEmail">Email</label>
            <input type="email" id="inputEmail" name="email" class="form-control" value="<?php print isset($_POST['email'])? htmlspecialchars($_POST['email']): ''; ?>" required>
            <br>
            <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Зарегистрироваться</button>
            <p><a href="./?controller=auth">Авторизация</a></p>
            <p class="mt-5 mb-3 text-muted">Zadarma &copy; <?php print date('Y'); ?></p>
        </form>
    </div>
<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/footer.tpl');
?>