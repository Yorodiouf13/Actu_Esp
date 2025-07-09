<?php
require_once __DIR__ . '/SoapUserServices.php';

ini_set("soap.wsdl_cache_enabled", "0"); // pour dev

$server = new SoapServer(null, [
    'uri' => "http://localhost/esp_news_webservices/services/soap.php" 
]);
$server->setClass('SoapUserService');
$server->handle();
?>
