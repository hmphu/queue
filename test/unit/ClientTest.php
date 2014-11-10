<?php
namespace Graze\Queue;

use Mockery as m;
use PHPUnit_Framework_TestCase as TestCase;
use RuntimeException;

class ClientTest extends TestCase
{
    public function setUp()
    {
        $this->adapter = m::mock('Graze\Queue\Adapter\AdapterInterface');
        $this->factory = m::mock('Graze\Queue\Message\MessageFactoryInterface');
        $this->handler = m::mock('Graze\Queue\Handler\AbstractAcknowledgementHandler');

        $this->messageA = $a = m::mock('Graze\Queue\Message\MessageInterface');
        $this->messageB = $b = m::mock('Graze\Queue\Message\MessageInterface');
        $this->messageC = $c = m::mock('Graze\Queue\Message\MessageInterface');
        $this->messages = [$a, $b, $c];

        $this->client = new Client($this->adapter, [
            'handler' => $this->handler,
            'message_factory' => $this->factory
        ]);
    }

    public function testInterface()
    {
        $this->assertInstanceOf('Graze\Queue\ConsumerInterface', $this->client);
        $this->assertInstanceOf('Graze\Queue\ProducerInterface', $this->client);
    }

    public function testCreate()
    {
        $this->factory->shouldReceive('createMessage')->once()->with('foo', ['bar'])->andReturn($this->messageA);

        $this->assertSame($this->messageA, $this->client->create('foo', ['bar']));
    }

    public function testSend()
    {
        $this->adapter->shouldReceive('enqueue')->once()->with($this->messages);

        $this->client->send($this->messages);
    }

    public function testReceive()
    {
        $worker = function(){};

        $this->adapter->shouldReceive('dequeue')->once()->with($this->factory, 1)->andReturn($this->messages);
        $this->handler->shouldReceive('__invoke')->once()->with($this->messages, $this->adapter, $worker);

        $this->client->receive($worker);
    }
}
