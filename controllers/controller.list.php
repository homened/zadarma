<?php 
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс controller_list отвечает за вывод списка телефонной книги
*/
class controller_list extends extController {
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
        if(empty($data_session)) {
            $this->core->libraries->url->toController(
                'auth'
            );
        } else {
            $user = $users->getDataByID($data_session['id-user']);
        }
        $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/list.tpl', array(
            'user'  => $user
        ));
    }
}

?>