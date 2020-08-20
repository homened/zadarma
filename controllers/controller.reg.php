<?php 
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс controller_reg отвечает за контроллер регистрации
*/
class controller_reg extends extController {
    function show() {
        $errors = array();
        $users = $this->core->models->users;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = isset($_POST['log'])? $_POST['log']: '';
            $pass = isset($_POST['pass'])? $_POST['pass']: '';
            $email = isset($_POST['email'])? $_POST['email']: '';
            $res = $users->register(
                $login,
                $pass,
                $email
            );
            $errors = $res['errors'];
            if($res['id'] > 0) {
                $this->core->libraries->url->toController(
                    'auth'
                );
            }
            
        }
        $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/reg.tpl', array(
            'errors'    => $errors
        ));
    }
}

?>