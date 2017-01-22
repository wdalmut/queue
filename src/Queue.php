<?php

namespace Corley\Queue;

class Queue
{
    private $name;
    private $adapter;

    public function __construct($queueName, QueueInterface $adapter)
    {
        $this->setName($queueName);
        $this->setAdapter($adapter);
    }

    protected function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    protected function setAdapter(QueueInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function send($message, array $options = [])
    {
        return $this->getAdapter()->send($this->getName(), $message, $options);
    }

    public function receive(array $options = [])
    {
        return $this->getAdapter()->receive($this->getName(), $options);
    }

    public function delete($receipt, array $options = [])
    {
        return $this->getAdapter()->delete($this->getName(), $receipt, $options);
    }

}
