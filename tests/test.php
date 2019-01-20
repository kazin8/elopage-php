<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Kazin8\Elopage\ElopageApi;
use Kazin8\Elopage\Exception\ElopageApiException;


$secret = 'your-secret';
$apiKey = 'your-key';

$api = new ElopageApi($apiKey, $secret);
$api->setLanguage($api::LANG_DE);

$response = $api->get("products");

if ($response->getSuccess()) {
    print_r($response->getData());
} else {
    throw new ElopageApiException($response->getError()->getMessage(), $response->getError()->getCode());
}