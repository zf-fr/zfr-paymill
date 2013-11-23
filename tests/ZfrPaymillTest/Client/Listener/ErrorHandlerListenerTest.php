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

namespace ZfrPaymillTest\Client\Listener;

use Guzzle\Common\Event;
use PHPUnit_Framework_TestCase;
use ZfrPaymill\Listener\ErrorHandlerListener;

class ErrorHandlerListenerTest extends PHPUnit_Framework_TestCase
{
    public function provider()
    {
        return array(
            array(
                20000,
                null,
                null
            ),
            array(
                40000,
                'ZfrPaymill\Exception\TransactionErrorException',
                'General problem with data.'
            ),
            array(
                50300,
                'ZfrPaymill\Exception\TransactionErrorException',
                'Technical error with 3D secure.'
            )
        );
    }

    /**
     * @dataProvider provider
     */
    public function testUserAgentIsIncluded($responseCode, $exception, $message)
    {
        if ($exception) {
            $this->setExpectedException($exception, $message, $responseCode);
        }

        $event   = new Event();
        $command = $this->getMock('Guzzle\Service\Command\CommandInterface');
        $event['command'] = $command;

        $request  = $this->getMock('Guzzle\Http\Message\Request', array(), array(), '', false);
        $response = $this->getMock('Guzzle\Http\Message\Response', array(), array(), '', false);

        $command->expects($this->once())
                ->method('toArray')
                ->will($this->returnValue(array(
                    'data' => array(
                        'response_code' => $responseCode
                    )
                )));

        $command->expects($this->any())->method('getRequest')->will($this->returnValue($request));
        $command->expects($this->any())->method('getResponse')->will($this->returnValue($response));

        $listener = new ErrorHandlerListener();
        $listener->handleError($event);
    }
}
