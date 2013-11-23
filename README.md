ZfrPaymill
==========

[![Latest Stable Version](https://poser.pugx.org/zfr/zfr-paymill/v/stable.png)](https://packagist.org/packages/zfr/zfr-paymill)

ZfrPaymill is a modern PHP library based on Guzzle for [Paymill payment system](https://www.paymill.com).

> Note : this library does not contain tests, mainly because I'm not sure about how to write tests for an API
wrapper. Don't hesitate to help on this ;-).

## Dependencies

* [Guzzle](http://www.guzzlephp.org): >= 3.5

## Installation

Installation of ZfrPaymill is only officially supported using Composer:

```sh
php composer.phar require zfr/zfr-paymill:1.*
```

## Tutorial

First, you need to instantiate the Paymill client, passing your private API key (you can find it in your Paymill
settings):

```php
$client = new PaymillClient('my-api-key');
```

The currently supported version of the API is version 2.0.

### How to use it?

Using the client is easy. For instance, here is how you'd create a new offer:

```php
$details = $client->createOffer(array(
    'name'     => 'MyOffer',
    'amount'   => 500,
    'currency' => 'EUR',
    'interval' => '1 MONTH'
));
```

The parameters have a direct one-to-one mapping with the official documentation (for any reference, you can also
check the `ZfrPaymill\Client\ServiceDescription\Paymill-2.0.php` file). To know what the responses look like, please
refer to the [official API reference](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/).

For most `get` methods, you must pass an `id` parameter, as follows:

$details = $client->getClient(array('id' => 'my-client-id'));

### Exceptions

ZfrPaymill tries its best to throw useful exceptions. Two kinds of exceptions can occur:

* Guzzle exceptions: by default, Guzzle automatically validate parameters according to rules defined in the
 service description **before** sending the actual request. If you encounter those exceptions, you likely have broken
 code.
* ZfrPaymill exceptions: those exceptions are thrown if an error occurred on Paymill side. Each exception implement
`ZfrPaymill\Exception\ExceptionInterface`.

Here are all the exceptions:

* `ZfrPaymill\Exception\UnauthorizedException`: your API key is likely to be wrong...
* `ZfrPaymill\Exception\TransactionErrorException`: transaction couldn't be completed.
* `ZfrPaymill\Exception\NotFoundException`: is thrown whenever client receives a 404 exception.
* `ZfrPaymill\Exception\ValidationErrorException`: some errors on your sent data.
* `ZfrPaymill\Exception\ServerErrorException`: any errors where Paymill is likely to be doing something wrong...

Usage:

```php
try {
    $client->createTransaction(array(
        'amount'   => 4000,
        'currency' => 'EUR',
        'token'    => '1234'
    ));
} catch (\ZfrPaymill\Exception\TransactionErrorException $exception) {
    // Seems the transaction failed, let's see why:
    $why = $exception->getMessage();

    // Let's also get the response to have more info:
    $response = $exception->getResponse();
} catch (\Exception $exception) {
    // Catch any other exception...
}
```

> For transaction/refund/preauthorization methods, Paymill may return status code 200 even if an error occured.
Paymill stores this error in a `response_code` property in the reponse. However, ZfrPaymill will automatically
checks if this is set, and throw a `TransactionErrorException`, so that you don't need to check for this yourself,
but only catch the exception.

### Advanced usage

#### Listeners

Because ZfrPaymill is based on Guzzle, you can take advantage of all its feature. For instance, you can add
listeners to various events by calling the `addSubscriber` method on the client.

### Complete reference

Here is a complete list of all methods, with a link to the official documentation for parameters names:

PAYMENT RELATED METHODS:

array createPayment(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#create-new-credit-card-payment-with)
array deletePayment(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#remove-payment)
array getPayment(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#payment-details)
array getPayments(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#list-payments)

PREAUTHORIZATION RELATED METHODS:

array createPreauthorization(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#create-new-preauthorization-with)
array deletePreauthorization(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#remove-preauthorizations)
array getPreauthorization(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#preauthorization-details)
array getPreauthorizations(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#list-preauthorizations)

TRANSACTION RELATED METHODS:

array createTransaction(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#create-new-transaction-with)
array getTransaction(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#update-transaction)
array getTransactions(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#transaction-details)
array updateTransaction(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#list-transactions)

REFUND RELATED METHODS:

array getRefund(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#refund-details)
array getRefunds(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#list-refunds)
array refundTransaction(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#refund-transaction)

CLIENT RELATED METHODS:

array createClient(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#create-new-client)
array deleteClient(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#remove-client)
array getClient(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#client-details)
array getClients(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#list-clients)
array updateClient(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#update-client)

OFFER RELATED METHODS:

array createOffer(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#create-new-offer)
array deleteOffer(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#remove-offer)
array getOffer(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#offer-details)
array getOffers(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#list-offers)
array updateOffer(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#update-offer)

SUBSCRIPTION RELATED METHODS:

array createSubscription(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#create-new-subscription)
array deleteSubscription(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#remove-subscription)
array getSubscription(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#subscription-details)
array getSubscriptions(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#list-subscriptions)
array updateSubscription(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#update-subscription)

WEBHOOK RELATED METHODS:

array createWebhook(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#create-new-url-webhook)
array deleteWebhook(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#remove-webhook)
array getWebhook(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#webhook-details)
array getWebhooks(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#list-webhooks)
array updateWebhook(array $args = array()) [doc](https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#update-webhook)
