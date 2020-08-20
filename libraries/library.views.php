<?php
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс library_views создан для работы с шаблонами
*/
class library_views extends extLibrary {
	/**
	 * -D- Отобразить шаблон
	 */
    public function show($src_view, $vars=array()) {
    	include($src_view);
	}
}
?>