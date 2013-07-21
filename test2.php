<?php
	error_reporting(E_ALL | E_STRICT);
	
	require_once 'application/controllers/EpubController.php';
	require_once 'application/controllers/MobiController.php';
	require_once 'application/controllers/PdfController.php';
	require_once('application/Bootstrap.php');

	$function = ucfirst("mobi");
	if (isset($_GET['function'])) {
		$function = ucfirst($_GET['function']);
	}
	$controllerName = "{$function}Controller";
	$modelName = "{$function}Model";
	$actionName = "create{$function}Action";
	
	$content_start =
	"<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"
	. "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"\n"
	. "    \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n"
	. "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n"
	. "<head>"
	. "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n"
	. "<title>Test Book</title>\n"
	. "</head>\n"
	. "<body>\n";
	
	$content_end = "</body>\n</html>\n";
	
	$options = array("html" => $content_start 
			. "<h1>Hello, World</h1>\n"
			. "<p><strong>Here is some text, wrapped in 'p' and 'strong' HTML tags</strong></p>\n"
			. "<p><em>Here is some text, wrapped in 'p' and 'em' HTML tags</em></p>\n"
			. $content_end);

	//use variable variables based on $_GET variable to instantiate class and call method
	$bootstrap = Bootstrap::singleton();
	$tools = $bootstrap->getTools(); 
	$transform = new TransformModel();
	
	$model = new $modelName($tools);
	$controller = new $controllerName($model, $tools, $transform);
	$controller->$actionName($options);
?>