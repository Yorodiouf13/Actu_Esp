<?php
require_once '..\app\services\SoapUserServices.php';

ini_set("soap.wsdl_cache_enabled", "0"); // pour dev

$server = new SoapServer(null, [
    'uri' => "http://localhost/esp_news_mvc/public/soap.php"
]);
$server->setClass('SoapUserService');
$server->handle();
?>
