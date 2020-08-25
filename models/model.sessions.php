<?php 
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс model_sessions отвечает за модель сессий пользователей
*/
class model_sessions extends extModel {
    /**
     * -D- Генерация уникального ключа сессии
     * -R- ?string
     */
    public function generateSessionKey($id_user, $ip) {
        $uid = md5(uniqid());
        $db = $this->core->libraries->db;
        $db->query('
            INSERT INTO
                sessions
            SET
                `id` = '. $db->quote($uid) .',
                `id-user` = '. $db->quote($id_user) .',
                `ip` = '. $db->quote($ip) .'
        ');
        return $uid;
    }
    /**
     * -D- Проверка ключа сессии
     * -R- array
     */
    public function getDataBySessionKey($session_key) {
        $db = $this->core->libraries->db;
        $r = $db->fetch('
            SELECT 
                *
            FROM
                sessions
            WHERE
                `id` = '. $db->quote($session_key) .'
            LIMIT 1
        ');
        return $r;
    }
    /**
     * -D- Удаление ключа сессии из базы данных
     */
    public function deleteSessionKey($session_key) {
        $db = $this->core->libraries->db;
        $r = $db->query('
            DELETE FROM 
                sessions
            WHERE
                `id` = '. $db->quote($session_key) .'
            LIMIT 1
        ');
    }
    /**
     * -D- Получения ключа сессии
     */
    public function getSessionKey() {
        return isset($_SESSION['session_key'])? $_SESSION['session_key']: NULL;
    }
    /**
     * -D- Сохранения ключа сессии на постоянной основе
     * Впоследствии можно перевести на Cookies
     */
    public function setSessionKey($session_key) {
        $_SESSION['session_key'] = $session_key;
    }
}

?>