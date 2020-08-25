<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/header.tpl');
?>
    <div class="d-flex justify-content-center">
        <form id="formReg" method="post" class="form-horizontal col-md-6 pt-3">
            <?php if(count($vars['errors']) > 0): ?>
                <div class="alert alert-danger" role="alert"><?php print implode(';', $vars['errors']) ?></div>
            <?php endif; ?>
            <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
            <div class="form-group">
                <label for="inputLogin">Логин</label>
                <input type="text" id="inputLogin" name="log" class="form-control" required autofocus value="<?php print isset($_POST['log'])? htmlspecialchars($_POST['log']): ''; ?>">
            </div>
            <div class="form-group">
                <label for="inputPassword">Пароль</label>
                <input type="password" id="inputPassword" name="pass" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" id="inputEmail" name="email" class="form-control" value="<?php print isset($_POST['email'])? htmlspecialchars($_POST['email']): ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="inputCaptcha">Проверочный код (капча)</label>
                <?php print $vars['captcha']; ?>
                <input type="number" id="inputCaptcha" name="captcha" class="form-control" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
            <p><a href="./?controller=auth">Авторизация</a></p>
            <p class="mt-5 mb-3 text-muted">Zadarma &copy; <?php print date('Y'); ?></p>
        </form>
    </div>
    <script>
        $('#formReg').bootstrapValidator({
            fields: {
                log: {
                    validators: {
                        regexp: {
                            regexp: /^[a-zA-Z0-9]+$/i,
                            message: 'Логин должен составлять только из латинских букв и цифры'
                        }
                    }
                },
                pass: {
                    validators: {
                        regexp: {
                            regexp: /^[A-Za-zА-Яа-я0-9]+$/i,
                            message: 'Пароль должен составлять только из букв и цифр'
                        }
                    }
                }
            }
        });
    </script>
<?php
    $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/footer.tpl');
?>