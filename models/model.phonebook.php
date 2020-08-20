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
     * -D- Получения пользователя по ID
     * -R- array
     */
    public function getData($id_user) {
        $db = $this->core->libraries->db;
        $r = $db->fetchAll('
            SELECT 
                firstname,
                surname,
                phone,
                email,
                `src-photo`
            FROM
                phonebook
            WHERE
                `id-user` = '. $db->quote($id_user) .'
        ');
        return $r;
    }
}

?>