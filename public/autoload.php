<?php

//define paths
define("DS",DIRECTORY_SEPARATOR);
define("ROOT",dirname(__DIR__).DS);
define("APP",ROOT."app".DS);
define("CORE",APP."core".DS);
define("CONTROLLERS",APP."controllers".DS);
define("VIEWS",APP."views".DS);
define("CONFIG",APP."config".DS);
define("MODELS",APP."models".DS);
define("LIBS",APP."libs".DS);

//define domain 
define("BURL","http://project2.test/");

require_once CONFIG."helpers.php";

//define constant database
define("DB_USER","root");
define("DB_NAME","crud_mvc");
define("DB_PASS","");
define("DB_HOST","localhost");

//autoload all classes
$modules = [ROOT,APP,CORE,VIEWS,CONTROLLERS,MODELS,CONFIG,LIBS];
set_include_path(get_include_path(). PATH_SEPARATOR.implode(PATH_SEPARATOR,$modules));
spl_autoload_register('spl_autoload');


new app();