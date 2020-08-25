<?php 
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.25;	
 * -D- Класс controller_detail отвечает за вывод контакта
*/
class controller_detail extends extController {
    function show() {
        $errors = array();
        $users = $this->core->models->users;
        $sessions = $this->core->models->sessions;
        $session_key = $sessions->getSessionKey();
        $data_session = $sessions->getDataBySessionKey($session_key);
        $phonebook = $this->core->models->phonebook;
        $contact = array();
        if(empty($data_session)) {
            $this->core->libraries->url->toController(
                'auth'
            );
        } else {
            $id = isset($_REQUEST['id'])? $_REQUEST['id']: '';
            $contact = $phonebook->getDataByID($id);
            $user = $users->getDataByID($data_session['id-user']);
        }
        $this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/detail.tpl', array(
            'user'     => $user,
            'contact'  => $contact
        ));
    }
}

?>