<?php
/**
 * -A, U- Подъяпольский Владимир Андреевич,
 ** vladimir.brolib@gmail.com;
 *
 * -Date, Time- 2020.08.18;	
 * -D- Класс Core собирает все составляющие (модели, контроллеры, библиотеки)
*/
abstract class extModel {
	protected $core;
	function __construct($core){
		$this->core = $core;
	}
}
abstract class extLibrary {
	protected $core;
	function __construct($core){
		$this->core = $core;
	}
}
abstract class extController {
	protected $core;
	function __construct($core){
		$this->core = $core;
	}
	/**
	 * -D- Основной метод отвечающий за шаблон
	 */
	function show() {
		$this->core->libraries->views->show(CONSTRUCTOR_PATH . '/views/controller.tpl');
	}
}
class Core{

    public $controllers, $models, $libraries;
	private $path, $settings;

	public function __construct($path){
		$this->path = $path;
	
		require($this->path."/configuration.php");
		
		$this->settings = $settings;
		
		date_default_timezone_set($this->settings['project']['timezone']);
		
		if($this->settings["project"]["debugging"]) {
			ini_set('display_errors', 1);
			error_reporting(E_ALL);
        }
        $this->initLibraries();
        $this->initControllers();
        $this->initModels();
    }
	/**
	 * -D, Method- Подключение к базе данных;
	*/
    public function connectDB() {
        $settings_mysql = $this->settings['mysql'];
        $host = $settings_mysql['host'];
        $port = $settings_mysql['port'];
        $dbname = $settings_mysql['dbname'];
        $user = $settings_mysql['user'];
        $pass = $settings_mysql['pass'];
        $this->libraries->db->connect(
            "mysql:host=$host;port=$port;dbname=$dbname",
            $user,
            $pass
        );
    }
	/**
	 * -D, Method- Подключение к ядру доступных моделей;
	*/
	private function initModels(){
		$this->models = new stdClass();
		$models= @glob($this->path."/models/model.*.php");
		
		foreach ($models as $model) {

			$match = array();
			preg_match("/\/model\.([^.]+)\.php$/ui", $model, $match);

			$modelName = strval($match[1]);
			
			$className = "model_".$modelName;
			include_once($model);

			if (class_exists($className) === true) {
				$this->models->{$modelName} = new $className($this);
			}

		}
	}
	/**
	 * -D, Method- Подключение к ядру доступных контроллеров;
	*/
	private function initControllers(){
		$this->controllers = new stdClass();
		$controllers= @glob($this->path."/controllers/controller.*.php");
		
		foreach ($controllers as $controller) {

			$match = array();
			preg_match("/\/controller\.([^.]+)\.php$/ui", $controller, $match);

			$constrollerName = strval($match[1]);
			
			$className = "controller_".$constrollerName;
			include_once($controller);

			if (class_exists($className) === true) {
				$this->controllers->{$constrollerName} = new $className($this);
			}

		}
    }
	/**
	 * -D, Method- Подключение к ядру доступных контроллеров;
	*/
	private function initLibraries(){
		$this->libraries = new stdClass();
		$libraries= @glob($this->path."/libraries/library.*.php");
		
		foreach ($libraries as $library) {

			$match = array();
			preg_match("/\/library\.([^.]+)\.php$/ui", $library, $match);

			$libraryName = strval($match[1]);

			$className = "library_".$libraryName;
			include_once($library);

			if (class_exists($className) === true) {
				$this->libraries->{$libraryName} = new $className($this);
			}

		}
	}
}

?>