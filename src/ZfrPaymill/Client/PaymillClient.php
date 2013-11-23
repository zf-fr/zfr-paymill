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

namespace ZfrPaymill;

use Guzzle\Common\Event;
use Guzzle\Plugin\ErrorResponse\ErrorResponsePlugin;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * @author  Michaël Gallego <mic.gallego@gmail.com>
 * @licence MIT
 *
 * PAYMENT RELATED METHODS:
 *
 * @method array createPayment(array $args = array()) {@command Paymill CreatePayment}
 * @method array deletePayment(array $args = array()) {@command Paymill DeletePayment}
 * @method array getPayment(array $args = array()) {@command Paymill GetPayment}
 * @method array getPayments(array $args = array()) {@command Paymill GetPayments}
 *
 * PREAUTHORIZATION RELATED METHODS:
 *
 * @method array createPreauthorization(array $args = array()) {@command Paymill CreatePreauthorization}
 * @method array deletePreauthorization(array $args = array()) {@command Paymill DeletePreauthorization}
 * @method array getPreauthorization(array $args = array()) {@command Paymill GetPreauthorization}
 * @method array getPreauthorizations(array $args = array()) {@command Paymill GetPreauthorizations}
 *
 * TRANSACTION RELATED METHODS:
 *
 * @method array createTransaction(array $args = array()) {@command Paymill CreateTransaction}
 * @method array getTransaction(array $args = array()) {@command Paymill GetTransaction}
 * @method array getTransactions(array $args = array()) {@command Paymill GetTransactions}
 * @method array updateTransaction(array $args = array()) {@command Paymill UpdateTransaction}
 *
 * REFUND RELATED METHODS:
 *
 * @method array getRefund(array $args = array()) {@command Paymill GetRefund}
 * @method array getRefunds(array $args = array()) {@command Paymill GetRefunds}
 * @method array refundTransaction(array $args = array()) {@command Paymill RefundTransaction}
 *
 * CLIENT RELATED METHODS:
 *
 * @method array createClient(array $args = array()) {@command Paymill CreateClient}
 * @method array deleteClient(array $args = array()) {@command Paymill DeleteClient}
 * @method array getClient(array $args = array()) {@command Paymill GetClient}
 * @method array getClients(array $args = array()) {@command Paymill GetClients}
 * @method array updateClient(array $args = array()) {@command Paymill UpdateClient}
 *
 * OFFER RELATED METHODS:
 *
 * @method array createOffer(array $args = array()) {@command Paymill CreateOffer}
 * @method array deleteOffer(array $args = array()) {@command Paymill DeleteOffer}
 * @method array getOffer(array $args = array()) {@command Paymill GetOffer}
 * @method array getOffers(array $args = array()) {@command Paymill GetOffers}
 * @method array updateOffer(array $args = array()) {@command Paymill UpdateOffer}
 *
 * SUBSCRIPTION RELATED METHODS:
 *
 * @method array createSubscription(array $args = array()) {@command Paymill CreateSubscription}
 * @method array deleteSubscription(array $args = array()) {@command Paymill DeleteSubscription}
 * @method array getSubscription(array $args = array()) {@command Paymill GetSubscription}
 * @method array getSubscriptions(array $args = array()) {@command Paymill GetSubscriptions}
 * @method array updateSubscription(array $args = array()) {@command Paymill UpdateSubscription}
 *
 * WEBHOOK RELATED METHODS:
 *
 * @method array createWebhook(array $args = array()) {@command Paymill CreateWebhook}
 * @method array deleteWebhook(array $args = array()) {@command Paymill DeleteWebhook}
 * @method array getWebhook(array $args = array()) {@command Paymill GetWebhook}
 * @method array getWebhooks(array $args = array()) {@command Paymill GetWebhooks}
 * @method array updateWebhook(array $args = array()) {@command Paymill UpdateWebhook}
 */
class PaymillClient extends Client
{
    /**
     * Paymill API version
     */
    const LATEST_API_VERSION = '2.0';

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * Constructor
     *
     * @param string $apiKey
     * @param string $version
     */
    public function __construct($apiKey, $version = self::LATEST_API_VERSION)
    {
        parent::__construct();

        $this->apiKey = $apiKey;

        $this->setDescription(ServiceDescription::factory(sprintf(
            __DIR__ . '/ServiceDescription/Paymill-%s.php',
            $version
        )));

        // Prefix the User-Agent by SDK version, and set the base URL
        $this->setUserAgent('zfr-paymill-php', true);

        // Add an event to set the Authorization param
        $dispatcher = $this->getEventDispatcher();

        $dispatcher->addListener('command.before_send', array($this, 'authorizeRequest'));
        $dispatcher->addSubscriber(new ErrorResponsePlugin());
    }

    /**
     * {@inheritdoc}
     */
    public function __call($method, $args = array())
    {
        return parent::__call(ucfirst($method), $args);
    }

    /**
     * Get current MailChimp API version
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->serviceDescription->getApiVersion();
    }

    /**
     * Authorize the request
     *
     * @internal
     * @param  Event $event
     * @return void
     */
    public function authorizeRequest(Event $event)
    {
        /* @var \Guzzle\Service\Command\CommandInterface $command */
        $command = $event['command'];
        $request = $command->getRequest();

        $request->setAuth($this->apiKey);
    }
}
