<?php 
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс model_auth отвечает за модель пользователей
*/
class model_users extends extModel {
    /**
     * -D- Перевод пароля в md5
     * Впоследствии можно внедрить уникальный ключик для генерации
     */
    public function passToMD5($pass) {
        return md5($pass);
    }
    /**
     * -D- Регистрация пользователя
     * -R- array
     */
    public function register($login, $pass, $email) {
        $db = $this->core->libraries->db;
        $res = array(
            'id'        => NULL,
            'errors'    => array()
        );
        $login = trim($login);
        $pass = trim($pass);
        if(mb_strlen($email, 'UTF-8') === 0) {
            $res['errors'][] = 'Email не может быть пустым';
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $res['errors'][] = 'Email введен не верно';
        }
        if(mb_strlen($pass, 'UTF-8') === 0) {
            $res['errors'][] = 'Пароль не может быть пустым';
        } elseif(mb_strlen($pass, 'UTF-8') > 30) {
            $res['errors'][] = 'Пароль не может превышать 30 символов';
        } elseif(!preg_match('/^[A-Za-zА-Яа-я0-9]+$/', $login)) {
            $res['errors'][] = 'Пароль должен составлять только из букв и цифры';
        }
        if(mb_strlen($login, 'UTF-8') === 0) {
            $res['errors'][] = 'Логин не может быть пустым';
        } elseif(mb_strlen($login, 'UTF-8') > 16) {
            $res['errors'][] = 'Логин не может превышать 16 символов';
        } elseif(!preg_match('/^[A-Za-z0-9]+$/', $login)) {
            $res['errors'][] = 'Логин должен составлять только из латинских букв и цифры';
        }
        $res_login = $this->findUserByLogin($login);
        $res_email = $this->findUserByEmail($email);
        if($res_login['id'] > 0) {
            $res['errors'][] = 'Пользователь с таким логином уже существует';
        }
        if($res_email['id'] > 0) {
            $res['errors'][] = 'Пользователь с таким email уже существует';
        }
        if(count($res['errors']) === 0) {
            $pass_md5 = $this->passToMD5($pass);
            $r = $db->query('
                INSERT INTO
                    users
                SET
                    `login` = '. $db->quote($login) .',
                    `pass` = '. $db->quote($pass_md5) .',
                    `email` = '. $db->quote($email) .'
            ');
            $res['id'] = $db->lastId();
        }

        return $res;
    }
    /**
     * -D- Проверка зарегистрированного пользователя по логину и паролю
     * -R- array
     */
    public function checkUser($login, $pass) {
        $db = $this->core->libraries->db;
        $res = array(
            'id'        => NULL,
            'errors'    => array()
        );
        $login = trim($login);
        $pass = trim($pass);
        if(mb_strlen($login, 'UTF-8') === 0) {
            $res['errors'][] = 'Логин должен быть заполнен';
        }
        if(mb_strlen($pass, 'UTF-8') === 0) {
            $res['errors'][] = 'Пароль должен быть заполнен';
        }
        if(count($res['errors']) === 0) {
            $pass_md5 = $this->passToMD5($pass);
            $r = $db->fetch('
                SELECT 
                    id
                FROM
                    users
                WHERE
                    `login` = '. $db->quote($login) .' AND
                    `pass` = '. $db->quote($pass_md5) .'
                LIMIT 1
            ');
            $res['id'] = $r['id'];
            if(empty($res['id'])) {
                $res['errors'][] = 'Пользователь не найден';
            }
        }

        return $res;
    }
    /**
     * -D- Получения пользователя по ID
     * -R- array
     */
    public function getDataByID($id) {
        $db = $this->core->libraries->db;
        $r = $db->fetch('
            SELECT 
                id,
                login,
                email
            FROM
                users
            WHERE
                `id` = '. $db->quote($id) .'
            LIMIT 1
        ');
        return $r;
    }
    /**
     * -D- Поиск пользователя по логину
     * -R- array
     */
    public function findUserByLogin($login) {
        $db = $this->core->libraries->db;
        $res = array(
            'id'        => NULL,
            'errors'    => array()
        );
        $login = trim($login);
        if(mb_strlen($login, 'UTF-8') === 0) {
            $res['errors'][] = 'Логин должен быть заполнен';
        }
        if(count($res['errors']) === 0) {
            $r = $db->fetch('
                SELECT 
                    id
                FROM
                    users
                WHERE
                    `login` = '. $db->quote($login) .'
                LIMIT 1
            ');
            $res['id'] = $r['id'];
        }

        return $res;
    }
    /**
     * -D- Поиск пользователя по email
     * -R- array
     */
    public function findUserByEmail($email) {
        $db = $this->core->libraries->db;
        $res = array(
            'id'        => NULL,
            'errors'    => array()
        );
        $email = trim($email);
        if(mb_strlen($email, 'UTF-8') === 0) {
            $res['errors'][] = 'Email должен быть заполнен';
        }
        if(count($res['errors']) === 0) {
            $r = $db->fetch('
                SELECT 
                    id
                FROM
                    users
                WHERE
                    `email` = '. $db->quote($email) .'
                LIMIT 1
            ');
            $res['id'] = $r['id'];
        }

        return $res;
    }
}

?>