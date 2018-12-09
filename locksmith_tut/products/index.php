<?php
include_once('../app/config.php');
include_once("../app/modules/products/controller/controller.php");

$products = new Products();
$products->invoke();
$content = $products->html;

include_once("../app/skin/templates/2cols-right.php");