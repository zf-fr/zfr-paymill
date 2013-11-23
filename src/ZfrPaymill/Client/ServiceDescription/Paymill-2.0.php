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

return array(
    'name'        => 'Paymill',
    'apiVersion'  => '2.0',
    'baseUrl'     => 'https://api.paymill.com',
    'description' => 'Paymill is a payment system',
    'operations'  => array(
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
            'summary'          => 'Get details about an existing webhook',
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
            'summary'          => 'Create a new webhook (either URL or e-mail)',
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
