<?php
namespace Corley\Queue;

class QueueTest extends \PHPUnit_Framework_TestCase
{
    public function testSendWithoutOptions()
    {
        $adapter = $this->prophesize("Corley\\Queue\\QueueInterface");
        $adapter->send("test_queue", "test", [])->willReturn("ok");

        $sut = new Queue("test_queue", $adapter->reveal());
        $this->assertEquals("ok", $sut->send("test"));
    }

    public function testReturnAdapterValueOnSend()
    {
        $adapter = $this->prophesize("Corley\\Queue\\QueueInterface");
        $adapter->send("test_queue", "test", ["delay" => "ok"])->willReturn("ok");

        $sut = new Queue("test_queue", $adapter->reveal());
        $this->assertEquals("ok", $sut->send("test", ["delay" => "ok"]));
    }

    public function testReceiveMessagesFromQueueWithoutOptions()
    {
        $adapter = $this->prophesize("Corley\\Queue\\QueueInterface");
        $adapter->receive("test_queue", [])->willReturn([1, "first message"]);

        $sut = new Queue("test_queue", $adapter->reveal());
        $this->assertEquals([1, "first message"], $sut->receive());
    }

    public function testReceiveMessagesFromQueue()
    {
        $adapter = $this->prophesize("Corley\\Queue\\QueueInterface");
        $adapter->receive("test_queue", ["delay" => "ok"])->willReturn([1, "first message"]);

        $sut = new Queue("test_queue", $adapter->reveal());
        $this->assertEquals([1, "first message"], $sut->receive(["delay" => "ok"]));
    }

    public function testDeleteFromQueue()
    {
        $adapter = $this->prophesize("Corley\\Queue\\QueueInterface");
        $adapter->delete("test_queue", "receipt", ["force" => true])->willReturn(true);

        $sut = new Queue("test_queue", $adapter->reveal());
        $this->assertEquals(true, $sut->delete("receipt", ["force" => true]));
    }

    public function testDeleteFromQueueWithoutOptions()
    {
        $adapter = $this->prophesize("Corley\\Queue\\QueueInterface");
        $adapter->delete("test_queue", "receipt", [])->willReturn(true);

        $sut = new Queue("test_queue", $adapter->reveal());
        $this->assertEquals(true, $sut->delete("receipt"));
    }
}
