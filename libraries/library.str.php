<?php
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.25;	
 * -D- Класс library_str отвечает за работу с строками
*/
class library_str {
    /**
     * -D- G
     */
    public function number2string($n) {
       return (new MessageFormatter('ru-RU', '{n, spellout}'))->format(['n' => $n]);
    }
}
?>