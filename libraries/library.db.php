<?php
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс library_db создан на основе паттерна singleton, отвечает за подключение и запросы к базе данных
*/
class library_db {
    static private $instance; 
    public function connect($dsn, $username=false, $password=false, $driver_options=array()) {
        if(!self::$instance) { 
	        try {
			   self::$instance = new PDO($dsn, $username, $password, $driver_options);
			} catch (PDOException $e) { 
			   die('Ошибка подключения к базе данных ' . $e->getMessage());
			}
    	}
      	return self::$instance;    	    	
	}
	/**
	 * -D- SQL запрос в базу данных
	 * -R- PDOStatement object
	 */
    public function query($statement) {
    	return self::$instance->query($statement);
	}
	/**
	 * -D- SQL запрос в базу данных с получением записей
	 * -R- array
	 */
    public function fetchAll($statement) {
    	return self::$instance->query($statement)->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * -D- SQL запрос в базу данных с получением одной записи
	 * -R- array
	 */
    public function fetch($statement) {
    	return self::$instance->query($statement)->fetch(PDO::FETCH_ASSOC);    	
	}
	/**
	 * -D- Получение последнего вставленного ID
	 * -R- string
	 */
	public function lastId($name=NULL) {
		return self::$instance->lastInsertId($name);
	}
	/**
	 * -D- Escape string
	 * -R- string
	 */
    public function quote($string) {
    	return self::$instance->quote($string);
	}
}

?>