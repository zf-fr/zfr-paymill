<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

$errors = array(
    array(
        'class' => 'ZfrPaymill\Exception\UnauthorizedException',
        'code'  => 401
    ),
    array(
        'class' => 'ZfrPaymill\Exception\TransactionErrorException',
        'code'  => 403
    ),
    array(
        'class' => 'ZfrPaymill\Exception\NotFoundException',
        'code'  => 404
    ),
    array(
        'class' => 'ZfrPaymill\Exception\ValidationErrorException',
        'code'  => 412
    ),
    array(
        'class' => 'ZfrPaymill\Exception\ServerErrorException'
    )
);

return array(
    'name'        => 'Paymill',
    'apiVersion'  => '2.0',
    'baseUrl'     => 'https://api.paymill.com',
    'description' => 'Paymill is a payment system',
    'operations'  => array(
        /**
         * --------------------------------------------------------------------------------
         * PAYMENTS RELATED METHODS
         *
         * DOC: https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#document-payments
         * --------------------------------------------------------------------------------
         */

        'CreatePayment' => array(
            'httpMethod'       => 'POST',
            'uri'              => '/v2/payments',
            'summary'          => 'Create a new payment (optionally for a client)',
            'parameters'       => array(
                'token' => array(
                    'description' => 'Unique credit card token',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
                'client' => array(
                    'description' => 'Unique client identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                )
            )
        ),

        'DeletePayment' => array(
            'httpMethod'       => 'DELETE',
            'uri'              => '/v2/payments/{id}',
            'summary'          => 'Delete an existing payment',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Payment unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetPayment' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/payments/{id}',
            'summary'          => 'Get details about a payment',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Payment unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetPayments' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/payments',
            'summary'          => 'Get details about payments',
            'parameters'       => array(
                'count' => array(
                    'description' => 'How many payments to retrieve',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'offset' => array(
                    'description' => 'Offset',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'order' => array(
                    'description' => 'Define how to order results',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'created_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'card_type' => array(
                    'description' => 'Optionally filter by card type',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                    'enum'        => array(
                        'visa', 'mastercard', 'maestro', 'amex', 'jcb', 'diners', 'discover',
                        'china_union_pay', 'unknown'
                    )
                )
            )
        ),

        /**
         * --------------------------------------------------------------------------------
         * PRE-AUTHORIZATION RELATED METHODS
         *
         * DOC: https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#document-preauthorizations
         * --------------------------------------------------------------------------------
         */

        'CreatePreauthorization' => array(
            'httpMethod'       => 'POST',
            'uri'              => '/v2/preauthorizations',
            'summary'          => 'Create a new preauthorization payment (you need to specify either token OR payment)',
            'parameters'       => array(
                'token' => array(
                    'description' => 'Token identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'payment' => array(
                    'description' => 'Payment identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'amount' => array(
                    'description' => 'Amount (in cents) to be charged',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => true
                ),
                'currency' => array(
                    'description' => 'ISO 4217 formatted currency code',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'DeletePreauthorization' => array(
            'httpMethod'       => 'DELETE',
            'uri'              => '/v2/preauthorizations/{id}',
            'summary'          => 'Delete an existing preauthorization',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Preauthorization unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetPreauthorization' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/preauthorizations/{id}',
            'summary'          => 'Get details about a preauthorization',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Preauthorization unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetPreauthorizations' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/preauthorizations',
            'summary'          => 'Get details about preauthorizations',
            'parameters'       => array(
                'count' => array(
                    'description' => 'How many preauthorizations to retrieve',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'offset' => array(
                    'description' => 'Offset',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'order' => array(
                    'description' => 'Define how to order results',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'created_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'client' => array(
                    'description' => 'Client unique identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'payment' => array(
                    'description' => 'Payment unique identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'amount' => array(
                    'description' => 'Amount in cents (examples: 300, >300, <300...)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                )
            )
        ),

        /**
         * --------------------------------------------------------------------------------
         * TRANSACTION RELATED METHODS
         *
         * DOC: https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#document-transactions
         * --------------------------------------------------------------------------------
         */

        'CreateTransaction' => array(
            'httpMethod'       => 'POST',
            'uri'              => '/v2/transactions',
            'summary'          => 'Create a new transaction',
            'parameters'       => array(
                'amount' => array(
                    'description' => 'Amount (in cents) to be charged',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => true
                ),
                'currency' => array(
                    'description' => 'ISO 4217 formatted currency code',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
                'description' => array(
                    'description' => 'Short description to describe the transaction',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'client' => array(
                    'description' => 'Optional client identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'token' => array(
                    'description' => 'Token generated by JavaScript bridge (if set, neither "payment" nor "preauthorization" should be set)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'payment' => array(
                    'description' => 'Unique payment identifier (if set, neither "token" nor "preauthorization" should be set)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'preauthorization' => array(
                    'description' => 'Unique preauthorization identifier (if set, neither "token" nor "payment" should be set)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'fee_amount' => array(
                    'description' => 'Fee included in the transaction amount',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false
                ),
                'fee_payment' => array(
                    'description' => 'Unique fee payment identifier of the payment from which the fee will be charged',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
            )
        ),

        'GetTransaction' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/transactions/{id}',
            'summary'          => 'Get details about a transaction',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Transaction unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetTransactions' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/offers',
            'summary'          => 'Get details about transactions',
            'parameters'       => array(
                'count' => array(
                    'description' => 'How many transactions to retrieve',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'offset' => array(
                    'description' => 'Offset',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'order' => array(
                    'description' => 'Define how to order results',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'created_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'updated_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'client' => array(
                    'description' => 'Filter by unique client identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'payment' => array(
                    'description' => 'Filter by unique payment identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'amount' => array(
                    'description' => 'Amount in cents (examples: 300, >300, <300...)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'status' => array(
                    'description' => 'Optionally filter by status',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                    'enum'        => array(
                        'open', 'closed', 'failed', 'preauth', 'pending',
                        'refunded', 'partially_refunded', 'chargeback'
                    )
                )
            )
        ),

        'UpdateTransaction' => array(
            'httpMethod'       => 'PUT',
            'uri'              => '/v2/transactions/{id}',
            'summary'          => 'Update an existing transaction',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Transaction unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
                'description' => array(
                    'description' => 'Short description',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
            )
        ),

        /**
         * --------------------------------------------------------------------------------
         * REFUND RELATED METHODS
         *
         * DOC: https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#document-refunds
         * --------------------------------------------------------------------------------
         */

        'GetRefund' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/refunds/{id}',
            'summary'          => 'Get details about a refund',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Refund identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                )
            )
        ),

        'GetRefunds' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/refunds',
            'summary'          => 'Get details about refunds',
            'parameters'       => array(
                'count' => array(
                    'description' => 'How many refunds to retrieve',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'offset' => array(
                    'description' => 'Offset',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'order' => array(
                    'description' => 'Define how to order results',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'created_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'client' => array(
                    'description' => 'Filter by unique client identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'transaction' => array(
                    'description' => 'Filter by unique transaction identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'amount' => array(
                    'description' => 'Amount in cents (examples: 300, >300, <300...)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                )
            )
        ),

        'RefundTransaction' => array(
            'httpMethod'       => 'POST',
            'uri'              => '/v2/refunds/{transaction_id}',
            'summary'          => 'Refunds a transaction',
            'parameters'       => array(
                'transaction_id' => array(
                    'description' => 'Transaction identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
                'amount' => array(
                    'description' => 'Amount (in cents) to be charged',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => true
                ),
                'description' => array(
                    'description' => 'Optional description for the refund',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                )
            )
        ),

        /**
         * --------------------------------------------------------------------------------
         * CLIENT RELATED METHODS
         *
         * DOC: https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#document-clients
         * --------------------------------------------------------------------------------
         */

        'CreateClient' => array(
            'httpMethod'       => 'POST',
            'uri'              => '/v2/clients',
            'summary'          => 'Create a new client',
            'parameters'       => array(
                'email' => array(
                    'description' => 'Client email',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'description' => array(
                    'description' => 'Short description for the client',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                )
            )
        ),

        'DeleteClient' => array(
            'httpMethod'       => 'DELETE',
            'uri'              => '/v2/clients/{id}',
            'summary'          => 'Delete an existing client',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Client unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetClient' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/clients/{id}',
            'summary'          => 'Get details about a client',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Client unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetClients' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/clients',
            'summary'          => 'Get details about clients',
            'parameters'       => array(
                'count' => array(
                    'description' => 'How many subscriptions to retrieve',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'offset' => array(
                    'description' => 'Offset',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'order' => array(
                    'description' => 'Define how to order results',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'created_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'updated_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'payment' => array(
                    'description' => 'Optionally filter by a payment identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'subscription' => array(
                    'description' => 'Optionally filter by a subscription identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'offer' => array(
                    'description' => 'Optionally filter by an offer identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'email' => array(
                    'description' => 'Optionally filter by client email',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'description' => array(
                    'description' => 'Optionally filter by client description',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
            )
        ),

        'UpdateClient' => array(
            'httpMethod'       => 'PUT',
            'uri'              => '/v2/clients/{id}',
            'summary'          => 'Update an existing client',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Client unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
                'name' => array(
                    'description' => 'Offer name',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
                'email' => array(
                    'description' => 'Client email',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'description' => array(
                    'description' => 'Short description for the client',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                )
            )
        ),

        /**
         * --------------------------------------------------------------------------------
         * OFFER RELATED METHODS
         *
         * DOC: https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#document-offers
         * --------------------------------------------------------------------------------
         */

        'CreateOffer' => array(
            'httpMethod'       => 'POST',
            'uri'              => '/v2/offers',
            'summary'          => 'Create a new offer (recurring plan)',
            'parameters'       => array(
                'name' => array(
                    'description' => 'Offer name',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
                'amount' => array(
                    'description' => 'Amount (in cents) to be charged',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => true
                ),
                'currency' => array(
                    'description' => 'ISO 4217 formatted currency code',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
                'interval' => array(
                    'description' => 'Interval to define how often the client should be charged (format should be number DAY|WEEK|MONTH|YEAR)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
                'trial_period_days' => array(
                    'description' => 'If specified, wait this number of days before charging',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false
                )
            )
        ),

        'DeleteOffer' => array(
            'httpMethod'       => 'DELETE',
            'uri'              => '/v2/offers/{id}',
            'summary'          => 'Delete an existing offer',
            'errorResponses'   => $errors,
            'parameters'       => array(
                'id' => array(
                    'description' => 'Offer unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetOffer' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/offers/{id}',
            'summary'          => 'Get details about an offer',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Offer unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetOffers' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/offers',
            'summary'          => 'Get details about offers',
            'parameters'       => array(
                'count' => array(
                    'description' => 'How many subscriptions to retrieve',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'offset' => array(
                    'description' => 'Offset',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'order' => array(
                    'description' => 'Define how to order results',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'created_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'updated_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'name' => array(
                    'description' => 'Filter by offer name',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'amount' => array(
                    'description' => 'Amount in cents (examples: 300, >300, <300...)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'trial_period_days' => array(
                    'description' => 'Filter by this number of days before charging',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false
                )
            )
        ),

        'UpdateOffer' => array(
            'httpMethod'       => 'PUT',
            'uri'              => '/v2/offers/{id}',
            'summary'          => 'Update an existing offer',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Offer unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
                'name' => array(
                    'description' => 'Offer name',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        /**
         * --------------------------------------------------------------------------------
         * SUBSCRIPTION RELATED METHODS
         *
         * DOC: https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#document-subscriptions
         * --------------------------------------------------------------------------------
         */

        'CreateSubscription' => array(
            'httpMethod'       => 'POST',
            'uri'              => '/v2/subscriptions',
            'summary'          => 'Create a new subscription',
            'parameters'       => array(
                'offer' => array(
                    'description' => 'Unique offer identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
                'payment' => array(
                    'description' => 'Unique payment identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
                'client' => array(
                    'description' => 'Client identifier (if none, it uses the one from the payment)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'start_at' => array(
                    'description' => 'Unix-timestamp for the trial period start',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false
                ),
            )
        ),

        'DeleteSubscription' => array(
            'httpMethod'       => 'DELETE',
            'uri'              => '/v2/subscriptions/{id}',
            'summary'          => 'Delete an existing subscription',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Subscription unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetSubscription' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/subscriptions/{id}',
            'summary'          => 'Get details about a subscription',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Subscription unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        'GetSubscriptions' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/subscriptions',
            'summary'          => 'Get details about subscriptions',
            'parameters'       => array(
                'count' => array(
                    'description' => 'How many subscriptions to retrieve',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'offset' => array(
                    'description' => 'Offset',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'order' => array(
                    'description' => 'Define how to order results',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'created_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'offer' => array(
                    'description' => 'Unique offer identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                )
            )
        ),

        'UpdateSubscription' => array(
            'httpMethod'       => 'PUT',
            'uri'              => '/v2/subscriptions/{id}',
            'summary'          => 'Update an existing subscription',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Subscription unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
                'cancel_at_period_end' => array(
                    'description' => 'Cancel this subscription immediately or at the end of the current period?',
                    'location'    => 'query',
                    'type'        => 'boolean',
                    'required'    => true
                ),
                'offer' => array(
                    'description' => 'Offer unique identifier',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
                'payment' => array(
                    'description' => 'Unique identifier describing a payment of the client',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => true
                ),
            )
        ),

        /**
         * --------------------------------------------------------------------------------
         * WEBHOOKS RELATED METHODS
         *
         * DOC: https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#document-webhooks
         * --------------------------------------------------------------------------------
         */

        'CreateWebhook' => array(
            'httpMethod'       => 'POST',
            'uri'              => '/v2/webhooks',
            'summary'          => 'Create a new webhook (either URL or e-mail)',
            'parameters'       => array(
                'url' => array(
                    'description' => 'The URL of the webhook',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'email' => array(
                    'description' => 'The webhook email (must be a valid email address)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'event_types' => array(
                    'description' => 'Set of webhook events to listen to',
                    'location'    => 'query',
                    'type'        => 'array',
                    'required'    => true,
                    'items'       => array(
                        'type' => 'string',
                        'enum' => array(
                            'chargeback.executed', 'transaction.created', 'transaction.succeeded', 'transaction.failed',
                            'subscription.created', 'subscription.updated', 'subscription.deleted',
                            'subscription.succeeded', 'subscription.failed', 'refund.created', 'refund.succeeded',
                            'refund.failed', 'payout.transferred', 'invoice.available', 'app.merchant.activated',
                            'app.merchant.deactivated', 'app.merchant.rejected', 'client.updated'
                        )
                    )
                )
            )
        ),

        'DeleteWebhook' => array(
            'httpMethod'       => 'DELETE',
            'uri'              => '/v2/webhooks/{id}',
            'summary'          => 'Delete an existing webhook',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Webhook unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                )
            )
        ),

        'GetWebhook' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/webhooks/{id}',
            'summary'          => 'Get details about an existing webhook',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Webhook unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                )
            )
        ),

        'GetWebhooks' => array(
            'httpMethod'       => 'GET',
            'uri'              => '/v2/webhooks',
            'summary'          => 'Get details about existing webhooks',
            'parameters'       => array(
                'count' => array(
                    'description' => 'How many webhooks to retrieve',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'offset' => array(
                    'description' => 'Offset',
                    'location'    => 'query',
                    'type'        => 'integer',
                    'required'    => false,
                ),
                'order' => array(
                    'description' => 'Define how to order results',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'url' => array(
                    'description' => 'Filter by a webhook URL',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'email' => array(
                    'description' => 'Filter by a webhook email',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                ),
                'created_at' => array(
                    'description' => 'Timestamp',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false,
                )
            )
        ),

        'UpdateWebhook' => array(
            'httpMethod'       => 'PUT',
            'uri'              => '/v2/webhooks/{id}',
            'summary'          => 'Update an existing webhook (either URL or e-mail)',
            'parameters'       => array(
                'id' => array(
                    'description' => 'Webhook unique identifier',
                    'location'    => 'uri',
                    'type'        => 'string',
                    'required'    => true
                ),
                'url' => array(
                    'description' => 'The URL of the webhook',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'email' => array(
                    'description' => 'The webhook email (must be a valid email address)',
                    'location'    => 'query',
                    'type'        => 'string',
                    'required'    => false
                ),
                'event_types' => array(
                    'description' => 'Set of webhook events to listen to',
                    'location'    => 'query',
                    'type'        => 'array',
                    'required'    => true,
                    'items'       => array(
                        'type' => 'string',
                        'enum' => array(
                            'chargeback.executed', 'transaction.created', 'transaction.succeeded', 'transaction.failed',
                            'subscription.created', 'subscription.updated', 'subscription.deleted',
                            'subscription.succeeded', 'subscription.failed', 'refund.created', 'refund.succeeded',
                            'refund.failed', 'payout.transferred', 'invoice.available', 'app.merchant.activated',
                            'app.merchant.deactivated', 'app.merchant.rejected', 'client.updated'
                        )
                    )
                )
            )
        ),
    )
);
