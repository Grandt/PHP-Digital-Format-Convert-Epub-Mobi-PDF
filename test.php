<?php
	error_reporting(E_ALL | E_STRICT);
	
	require_once 'application/controllers/EpubController.php';
	require_once 'application/controllers/MobiController.php';
	require_once 'application/controllers/PdfController.php';
	require_once('application/Bootstrap.php');

	$function = ucfirst("epub");
	
	$controllerName = "{$function}Controller";
	$modelName = "{$function}Model";
	$actionName = "create{$function}Action";
	$options = null;

	//use variable variables based on $_GET variable to instantiate class and call method
	$bootstrap = Bootstrap::singleton();
	$tools = $bootstrap->getTools(); 
	$transform = new TransformModel();
	
	$model = new $modelName($tools);
	$controller = new $controllerName($model, $tools, $transform);
	$controller->$actionName($options);
?>