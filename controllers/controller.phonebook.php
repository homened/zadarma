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
        $phonebook = $this->core->models->phonebook;
        $session_key = $sessions->getSessionKey();
        $data_session = $sessions->getDataBySessionKey($session_key);
        if(empty($data_session)) {
            $this->core->libraries->url->toController(
                'auth'
            );
        }
        switch($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                header('Content-Type: application/json');
                if(isset($_GET['id'])) {
                    $id = isset($_GET['id'])? $_GET['id']: NULL;
                    $data = $phonebook->getDataByID(
                        $id
                    );
                    if($data['id-user'] != $data_session['id-user']) {
                        header('HTTP/1.0 403 Forbidden');
                        print json_encode(array(
                            'row'    => array(),
                            'error'  => 'Вы не имеете прав на просмотр данного контакта'
                        ));
                    } else {
                        print json_encode(array(
                            'row'    => $data
                        ));
                    }
                    exit;
                } else {
                    $data = $phonebook->getData(
                        $data_session['id-user']
                    );
                    function htmlspecialchars_array_values($s) {
                        return htmlspecialchars($s);
                    }
                    foreach($data as &$row) {
                        $row = array_map('htmlspecialchars_array_values', array(
                            $row['firstname'],
                            $row['lastname'],
                            $row['phone'],
                            $row['email'],
                            $row['src-photo'],
                            $row['id']
                        ));
                    }
                    print json_encode(array(
                        'data'  => $data
                    ));
                    exit;
                }
                break;
            case 'POST':
                header('Content-Type: application/json');
                if(isset($_POST['id'])) {
                    $id = isset($_POST['id'])? $_POST['id']: '';
                    $firstname = isset($_POST['firstname'])? $_POST['firstname']: '';
                    $lastname = isset($_POST['lastname'])? $_POST['lastname']: '';
                    $phone = isset($_POST['phone'])? $_POST['phone']: '';
                    $email = isset($_POST['email'])? $_POST['email']: '';
                    $photo = isset($_FILES['photo'])? $_FILES['photo']: '';

                    $res = $phonebook->editContact(
                        $id,
                        $data_session['id-user'],
                        $firstname,
                        $lastname,
                        $phone,
                        $email,
                        $photo
                    );
                    print json_encode($res);
                } else {
                    $firstname = isset($_POST['firstname'])? $_POST['firstname']: '';
                    $lastname = isset($_POST['lastname'])? $_POST['lastname']: '';
                    $phone = isset($_POST['phone'])? $_POST['phone']: '';
                    $email = isset($_POST['email'])? $_POST['email']: '';
                    $photo = isset($_FILES['photo'])? $_FILES['photo']: '';

                    $res = $phonebook->addContact(
                        $data_session['id-user'],
                        $firstname,
                        $lastname,
                        $phone,
                        $email,
                        $photo
                    );
                    print json_encode($res);
                }
                exit;
                break;
        }
    }
}

?>