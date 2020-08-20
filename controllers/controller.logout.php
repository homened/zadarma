<?php 
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс controller_logout отвечает за выход пользователя из системы
*/
class controller_logout extends extController {
    function show() {
        $errors = array();
        $users = $this->core->models->users;
        $sessions = $this->core->models->sessions;
        $session_key = $sessions->getSessionKey();
        $data_session = $sessions->getDataBySessionKey($session_key);
        $user = array(
            'login' => NULL,
            'email' => NULL
        );
        if(!empty($data_session)) {
            $sessions->deleteSessionKey($session_key);
        }
        $sessions->setSessionKey(NULL);
        $this->core->libraries->url->toController(
            'auth'
        );
    }
}

?>