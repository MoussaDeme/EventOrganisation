<?php
set_include_path("./src");

require_once("Router.php");
require_once("AdminRouter.php");
require_once("model/BdConnection.php");


$router = new AdminRouter();
$router->main($bd);

?>
