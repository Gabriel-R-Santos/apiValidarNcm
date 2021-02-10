<?php
class core {

	public function run() {
		$view  = '';
		$url = 	'/'.(isset($_GET['url'])?$_GET['url']:'');
		
		$params = array();
		if(!empty($url) && $url != '/') {
						
			$url = explode('/', $url);			
			array_shift($url);
			$currentController = $url[0].'Controller';
			$view =  $url[0];
			
			array_shift($url);			
			if(isset($url[0]) && $url[0] != '/') {	
				$currentAction = $url[0];
				array_shift($url);				
			} else {
				$currentAction = 'index';
			}

			if(count($url) > 0) {
				$params = $url;
			}

		} else {			
			$currentController = 'WebServicesController';
			$currentAction = 'index';
		}

		
		if(!file_exists('controllers/'.$currentController.'.php')) {
			
			$currentController = 'WebServicesController';
			$currentAction = 'index';
			$params = array($view);			
		}	

		$c = new $currentController();	
		
		if(!method_exists($c, $currentAction)) {
			$currentAction = 'index';
		}
		
		call_user_func_array(array($c, $currentAction) , $params);
	}

}