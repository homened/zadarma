<?php 
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс model_auth отвечает за модель телефонной книги
*/
class model_phonebook extends extModel {
    /**
     * -D- Получения списка контактов по ID пользователя
     * -R- array
     */
    public function getData($id_user) {
        $db = $this->core->libraries->db;
        $r = $db->fetchAll('
            SELECT 
                firstname,
                lastname,
                phone,
                email,
                `src-photo`,
                id
            FROM
                phonebook
            WHERE
                `id-user` = '. $db->quote($id_user) .'
            ORDER BY
                id
        ');
        return $r;
    }
    /**
     * -D- Получения контакта по ID
     * -R- array
     */
    public function getDataByID($id_contact) {
        $db = $this->core->libraries->db;
        $r = $db->fetch('
            SELECT 
                firstname,
                lastname,
                phone,
                email,
                `src-photo`,
                id,
                `id-user`
            FROM
                phonebook
            WHERE
                `id` = '. $db->quote($id_contact) .'
            LIMIT 1
        ');
        return $r;
    }
    /**
     * -D- Добавление контакта
     * -R- array
     */
    public function addContact($id_user, $firstname, $lastname, $phone, $email, $photo) {
        $db = $this->core->libraries->db;
        $res = array(
            'id'        => NULL,
            'errors'    => array()
        );
        $firstname = trim($firstname);
        $lastname = trim($lastname);
        $phone = trim($phone);
        $email = trim($email);
        $photo_src = '/uploads/face.png';
        if(is_array($photo) && isset($photo['type']) && isset($photo['error']) && isset($photo['size'])) {
            $res_upload = $this->core->libraries->files->upload($photo);
            if(!$res_upload['upload']) {
                $res['errors'][] = $res_upload['error'];
            } else {
                $photo_src = $res_upload['tmp'];
            }
        }
        if(mb_strlen($firstname, 'UTF-8') === 0) {
            $res['errors'][] = 'Имя не может быть пустым';
        }
        if(mb_strlen($lastname, 'UTF-8') === 0) {
            $res['errors'][] = 'Фамилия не может быть пустым';
        }
        if(mb_strlen($phone, 'UTF-8') === 0) {
            $res['errors'][] = 'Телефон не может быть пустым';
        }
        if(mb_strlen($email, 'UTF-8') === 0) {
            $res['errors'][] = 'Email не может быть пустым';
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $res['errors'][] = 'Email введен не верно';
        }

        if(count($res['errors']) === 0) {
            $r = $db->query('
                INSERT INTO
                    phonebook
                SET
                    `firstname` = '. $db->quote($firstname) .',
                    `lastname` = '. $db->quote($lastname) .',
                    `phone` = '. $db->quote($phone) .',
                    `email` = '. $db->quote($email) .',
                    `id-user` = '. $db->quote($id_user) .',
                    `src-photo` = '. $db->quote($photo_src) .'
            ');
            $res['id'] = $db->lastId();
        }

        return $res;
    }
    /**
     * -D- Редактирование контакта
     * -R- array
     */
    public function editContact($id, $id_user, $firstname, $lastname, $phone, $email, $photo) {
        $db = $this->core->libraries->db;
        $res = array(
            'status'    => false,
            'errors'    => array()
        );
        $id = trim($id);
        $firstname = trim($firstname);
        $lastname = trim($lastname);
        $phone = trim($phone);
        $email = trim($email);
        $photo_src = '/uploads/face.png';
        $contact = $this->getDataByID($id);

        if(!empty($contact)) {
            $photo_src = $contact['src-photo'];
        }
        if(is_array($photo) && isset($photo['type']) && isset($photo['error']) && isset($photo['size'])) {
            $res_upload = $this->core->libraries->files->upload($photo);
            if(!$res_upload['upload']) {
                //$res['errors'][] = $res_upload['error'];
            } else {
                $photo_src = $res_upload['tmp'];
            }
        }
        if(mb_strlen($id, 'UTF-8') === 0) {
            $res['errors'][] = 'ID не может быть пустым';
        } elseif(empty($contact)) {
            $res['errors'][] = 'Контакт не найден по ID';
        }
        if(mb_strlen($firstname, 'UTF-8') === 0) {
            $res['errors'][] = 'Имя не может быть пустым';
        }
        if(mb_strlen($lastname, 'UTF-8') === 0) {
            $res['errors'][] = 'Фамилия не может быть пустым';
        }
        if(mb_strlen($phone, 'UTF-8') === 0) {
            $res['errors'][] = 'Телефон не может быть пустым';
        }
        if(mb_strlen($email, 'UTF-8') === 0) {
            $res['errors'][] = 'Email не может быть пустым';
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $res['errors'][] = 'Email введен не верно';
        }

        if(count($res['errors']) === 0) {
            $r = $db->query('
                UPDATE
                    phonebook
                SET
                    `firstname` = '. $db->quote($firstname) .',
                    `lastname` = '. $db->quote($lastname) .',
                    `phone` = '. $db->quote($phone) .',
                    `email` = '. $db->quote($email) .',
                    `id-user` = '. $db->quote($id_user) .',
                    `src-photo` = '. $db->quote($photo_src) .'
                WHERE
                    `id` = '. $db->quote($id) .'
            ');
            $res['status'] = true;
        }

        return $res;
    }
}

?>