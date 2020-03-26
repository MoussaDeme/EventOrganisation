<?php
set_include_path("./src");

require_once("Router.php");
require_once("model/BdConnection.php");



$router = new Router();
$router->main($bd);

?>
