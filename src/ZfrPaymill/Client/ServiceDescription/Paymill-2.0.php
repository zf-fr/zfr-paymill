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
    'description' => 'Paymill is a payment system',
    'operations'  => array(
        /**
         * --------------------------------------------------------------------------------
         * WEBHOOKS RELATED METHODS
         * --------------------------------------------------------------------------------
         */

        'CreateWebhook' => array(
            'httpMethod'       => 'POST',
            'uri'              => 'webhook',
            'summary'          => 'Create a new webhook (either URL or e-mail)',
            'documentationUrl' => 'https://www.paymill.com/en-gb/documentation-3/reference/api-reference/#document-webhooks',
            'parameters'       => array(
                'url' => array(
                    'description' => 'The URL of the webhook',
                    'location'    => 'json',
                    'type'        => 'string',
                    'required'    => false
                ),
                'email' => array(
                    'description' => 'The webhook email (must be a valid email address)',
                    'location'    => 'json',
                    'type'        => 'string',
                    'required'    => false
                ),
                'event_types' => array(
                    'description' => 'Set of webhook events to listen to',
                    'location'    => 'json',
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
