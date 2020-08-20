<?php
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс library_url отвечает за работу с url строкой
*/
class library_url {
    /**
     * -D- Перенаправление на другую страницу
     */
    public function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
    /**
     * -D- Перенаправление на определенный контроллер
     */
    public function toController($controller) {
        $this->redirect('./?controller=' . $controller);
    }
}
?>