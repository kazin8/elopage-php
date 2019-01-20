# Elopage
Elopage API php wrapper

http://apidoc.elopage.com

**NOTE:**

Attention!

Api service is not standardized, returns errors in different formats, does not rely on the returned server codes and so on.
Some attempts have been made in this library to standardize responses, but this does not always work correctly. Especially in terms of translation. 

I apologize for the unstable work.

## Install
```
composer require kazin8/elopage
```


## What can you do?

### Authenticate

Authenticate your account by using your secret API key in the request. You can create or renew your API keys in your dashboard settings. Keep your API and secret keys secret. Please do not share your API keys publicly on Github and so forth.

On production you must create requests over HTTPS, otherwise calls will fail. Sandbox requests can be with HTTP.

### Sandbox and payments credentials

You can use api in stage mode (for testing).

Credentials for test payments will not work on the production environment. For now, we don’t have the option to test payments on production except for real payments.

##### Credit Card

The following credit card numbers can be used to test Visa or Mastercard payments.


| Parameter        | Value           |
| ------------- |:-------------:|
| CVV    | Any 3 digits                                                                 |
| Date   | any date in the future, before 2030                                          |
| Number | 5017670000005900<br>5017670000006700<br>5017670000007500<br>5017670000008300 |

##### Sofort Überweisung (Klarna)

The following online banking and account credentials can be used to test Sofort Überweisung (Klarna) payments.

| Parameter        | Value           |
| ------------- |:-------------:|
| Country of your bank    | Germany |
| Sort code or BIC   | 88888888  |
| Account number | 234567 |
| PIN | 12345 |
| TAN | 12345 |

##### SEPA

Please use the following payment information to test both instant successful and failed payments. Be aware that the initial payment takes 5 days to process. During that time the payment will have the “pending” status. SEPA payments are available for reseller-type-accounts.

| Description        | IBAN           |
| ------------- |:-------------:|
| To do an instant successful transaction | DE89370400440532013000 |
| To do an instant failed transaction   | DE62370400440532013001  |

##### Paypal

Please use the following Paypal credentials to test payments on staging. Beware that you do not have an option to check the payment status on a Paypal account (by logging in to Paypal) unless you connect your own Paypal account on production.

| Parameter        | Value           |
| ------------- |:-------------:|
| Username    | info-buyer@elopage.com |
| Password   | 123elopage  |


### Create API instance

```
$api = new ElopageApi($apiKey, $secret, $testMode = false);
```
* apiKey - api key from your dashboard
* secret - secret key from your dashboard
* testMode - **false**|true use in test mode

### Set errors language


The library supports two language versions - **English (en)** and German (de).

English version is selected by default.

You can set another language:
```
$api->setLanguage($api::LANG_DE);
```


### Response objects

All methods return a universal response object. (instance of **ResponseDto** class).

If an error occurs, the **ErrorDto** class object is returned.

This object has several methods that will help you in working with api.

```
/* Get the list of products */ 
$response = $api->get('products');
```

#### Verify the success of the request

```
if ($response->isSuccess()) {
    // do something;
}
```
#### Get response data

```
if ($response->isSuccess()) {
    $data = $response->getData();
} else {
    $error = $response->getError();
}
```

#### Errors and exceptions

The error class has the following methods:

| Method        | Description |
| ------------- |:-------------:|
| getMessage | Returns the contents of the error in the selected language  |
| getCode   | Returns the internal library error code  |
| getCurlCode | Returns the http error code (if it exists) |


API errors list

| Code        | Description |
| ------------- |:-------------:|
| ERROR_UNKNOWN | Unknown error |
| ERROR_CURL   | Http call error reported by curl (#%s - %s)  |
| ERROR_UNAUTHORIZED | Auth error |
| ERROR_NOT_FOUND | API action not found |
| ERROR_BAD_SERVER_RESPONSE | Returned if the action was performed incorrectly and the server returned an error.| 

The library has its own exception, which you can throw in case of an error.

```
if ($response->isSuccess()) {
    $data = $response->getData();
} else {
    throw new ElopageApiException($response->getError()->getMessage(), $response->getError()->getCode());
}
```
## Api methods

For more information about input parameters and response structure, read the documentation: [Elopage api documentation](http://apidoc.elopage.com/)

### Product

##### Get product

```
$response = $api->get('products', $id);
```

##### Get products list

```
$response = $api->get('products');
```

##### Create product

```
$payload = [
  'name' => 'product name',
  'success_url' => 'elopage.com',
  'cancel_url' => 'elopage.com',
  'error_url' => 'elopage.com',
  'webhook_url' => 'elopage.com',
  'pricing_plans' => [ 
    [
      'form' => 'one_time',
      'preferences' => [
        'price' => '199.9',
        'old_price' => '200',
      ],
    ],
  ],
  'authors' => [
    [
      'id' => 4,
      'custom_commission_enabled' => true,
      'commission' => 10,
    ],
  ],
  'success_email' => [
    'subject_de' => 'test',
    'body_de' => '<p>Hallo %{first_name} %{last_name},</p>\n<p><br></p>\n<p>vielen Dank f&uuml;r die Bestellung.</p>\n<p><br></p>\n<p>Produktname: %{product_name}</p>\n<p>Betrag: %{amount}</p>\n<p>Zahlung: %{recurring_type}</p>\n<p><br></p>\n<p>Bitte jetzt hier klicken:</p>\n<p>%{next_button}</p>\n<p><br></p>\n<p>Sch&ouml;ne Gr&uuml;&szlig;e,</p>',
    'subject_en' => 'test',
    'body_en' => '<p>Hello %{first_name} %{last_name},</p>\n<p><br></p>\n<p>thanks for your order.</p>\n<p><br></p>\n<p>Product name: %{product_name}</p>\n<p>Amount: %{amount}</p>\n<p>Plan: %{recurring_type}</p>\n<p><br></p>\n<p>Now click here:</p>\n<p>%{next_button}</p>\n<p><br></p><p>Best regards,</p>',
  ],
];

$response = $api->post('products', $payload);
```

##### Update product

```
$id = 1;

$payload = [
  'name' => 'product name',
  'success_url' => 'elopage.com',
  'cancel_url' => 'elopage.com',
  'error_url' => 'elopage.com',
  'webhook_url' => 'elopage.com',
  'pricing_plans' => [
    [
      'id' => 1340,
      'form' => 'one_time',
      'preferences' => [
        'price' => '220',
        'old_price' => '200.0',
      ],
    ],
  ],
  'success_email' => [
    'subject_de' => 'test',
    'body_de' => '<p>Hallo %{first_name} %{last_name},</p>\n<p><br></p>\n<p>vielen Dank für die Bestellung.</p>\n<p><br></p>\n<p>Produktname: %{product_name}</p>\n<p>Betrag: %{amount}</p>\n<p>Zahlung: %{recurring_type}</p>\n<p><br></p>\n<p>Bitte jetzt hier klicken:</p>\n<p>%{next_button}</p>\n<p><br></p>\n<p>Schöne Grüße,</p>',
    'subject_en' => 'test',
    'body_en' => '<p>Hello %{first_name} %{last_name},</p>\n<p><br></p>\n<p>thanks for your order.</p>\n<p><br></p>\n<p>Product name: %{product_name}</p>\n<p>Amount: %{amount}</p>\n<p>Plan: %{recurring_type}</p>\n<p><br></p>\n<p>Now click here:</p>\n<p>%{next_button}</p>\n<p><br></p><p>Best regards,</p>',
  ],
];

$response = $api->put('products', $payload, $id);
```

### Publishers

##### Get publishers list

```
$response = $api->get('publishers');
```

##### Enroll publisher to program

```
$payload = [
  'affiliate_program_id' => 1
];

$response = $api->post("publishers/{$id}/enroll", $payload);
```

##### Unenroll publisher from program

```
$payload = [
  'affiliate_program_id' => 1
];

$response = $api->post("publishers/{$id}/unenroll", $payload);
```

### Pricing plans

##### Get pricing plan

```
$response = $api->get('pricing_plans', $id);
```

##### Create pricing plan

```
$payload = [
    'sales_page_id' => 1087,
    'pricing_plan' =>
        [
            'form' => 'split',
            'preferences' => [
                'p_count' => 2,
                'first_amount' => 0.5,
                'next_amount' => 2,
            ],
        ],
];

$response = $api->post('pricing_plans', $payload);
```

##### Delete pricing plan
```
$response = $api->delete('pricing_plans', $id);
```

### Payments

##### Get payment info

```
$response = $api->get('payments', $id);
```

### Refunds

##### Get refund info

```
$response = $api->get('payments', $id);
```

##### Create a refund

```
$paymentId = 1;
$payload = [];

$response = $api->post("payments/{$paymentId}/refund", $payload);
```

## Contributing
When contributing to this repository, please first discuss the change you wish to make via issue before making a pull request.

## Authors
Vladimir Vasyukov - [kazin8](https://github.com/kazin8)

## License
This project is licensed under the MIT License - see the [LICENSE](https://github.com/kazin8/elopage-php/blob/master/LICENSE.md) file for details