<?php 
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс controller_auth отвечает за контроллер авторизации
*/
class controller_auth extends extController {
    function show() {
        $errors = array();
        $users = $this->core->models->users;
        $sessions = $this->core->models->sessions;
        $session_key = $sessions->getSessionKey();
        $data_session = $sessions->getDataBySessionKey($session_key);
        if(!empty($data_session)) {
            $this->core->libraries->url->toController(
                'list'
            );
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = isset($_POST['log'])? $_POST['log']: '';
            $pass = isset($_POST['pass'])? $_POST['pass']: '';
            $res = $users->checkUser(
                $login,
                $pass
            );
            $errors = $res['errors'];

            if(count($res['errors']) === 0 && $res['id'] > 0) {
                $session_key = $sessions->generateSessionKey(
                    $res['id'],
                    $_SERVER['REMOTE_ADDR']
                );
                $sessions->setSessionKey($session_key);
                $this->core->libraries->url->toController('list');
            }
            
        }
        $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/auth.tpl', array(
            'errors'    => $errors
        ));
    }
}

?>