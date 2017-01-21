<?php
namespace Corley\Queue;

interface QueueInterface
{
    public function send($queueName, $message, array $options);
    public function receive($queueName, array $options);
    public function delete($queueName, $receipt, array $options);
}
