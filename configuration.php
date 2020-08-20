<?php
$settings = array(
	/**
	 * -D, Section- Настройки подключения MySQL;
	*/
	'mysql' => array(
		'host' 						=> '127.0.0.1', 
		'port'						=> '3306',
		'user' 						=> 'root',
		'pass' 						=> '',
		'dbname' 					=> 'zadarma',
    ),
	/**
	 * -D, Section- Настройки проекта;
	*/
	'project' => array(
        'debugging' => true,
        'timezone'	=> 'Europe/Moscow',
    )
);
?>