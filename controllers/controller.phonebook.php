<?php 
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс controller_reg отвечает за контроллер телефонной книги
*/
class controller_phonebook extends extController {
    function show() {
        $errors = array();
        $users = $this->core->models->users;
        $sessions = $this->core->models->sessions;
        $session_key = $sessions->getSessionKey();
        $data_session = $sessions->getDataBySessionKey($session_key);
        if(empty($data_session)) {
            $this->core->libraries->url->toController(
                'auth'
            );
        }
        header('Content-Type: application/json');
        $data = $this->core->models->phonebook->getData(
            $data_session['id-user']
        );
        foreach($data as &$row) {
            $row = array_values($row);
        }
        print json_encode(array(
            'data'  => $data
        ));
        exit;
    }
}

?>