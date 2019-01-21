<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Kazin8\Elopage\ElopageApi;
use Kazin8\Elopage\Exception\ElopageApiException;


$secret = 'your-secret';
$apiKey = 'your-key';

$api = new ElopageApi($apiKey, $secret);
$api->setLanguage($api::LANG_DE);

$response = $api->get("products");


$data = [
    'id' => 5,
    'action' => 'proccess_payment',
    'payer' => [
        'email' => 'asasgasg',
        'first_name' => 'asfasfasf'
    ],
    'publisher' => [
        'id' => 1,
        'email' => 'asfasfasf@fasfasf.com'
    ],
    'events' => [
        [
            'name' => 'asfasfsaf',
            'price' => '12125'
        ],
        [
            'name' => '15215gdgdsg',
            'price' => '12566'
        ],
    ],
    'tickets' => [
        [
            'count' => 1,
            'codes' => ['asf', 'asfasf']
        ],
        [
            'count' => 2,
            'codes' => ['as124', 'dsgsdg']
        ]
    ]
];

$dto = new \Kazin8\Elopage\Dto\WebhookDto($data);

if ($response->getSuccess()) {
    print_r($response->getData());
} else {
    throw new ElopageApiException($response->getError()->getMessage(), $response->getError()->getCode());
}