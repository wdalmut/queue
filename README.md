# Queue

Adaptable queue layers

[![Build Status](https://travis-ci.org/wdalmut/queue.svg?branch=master)](https://travis-ci.org/wdalmut/queue)

## Create

```php
$queue = new Queue("urls", $queueAdapter);
```

## Receive from queue

```php
list($receipt, $message) = $queue->receive();

// receive with options
list($receipt, $message) = $queue->receive(["timeout" => 15*60]);
```

## Send in queue

```php
$queue->send("my message");

// send with options
$queue->send("my message", ["delay" => 20]);
```

## Delete from queue

```php
$queue->delete($receipt);

// delete with options
$queue->delete($receipt, ["delay" => 20]);
```

# Queue Interface (for adapters)

You have to implement 3 methods from `Corley\Queue\QueueInterface`

```php
public function send($queueName, $message, array $options);
public function receive($queueName, array $options);
public function delete($queueName, $receipt, array $options);
```

## Manage different adapters options

Just use functions

```php
$queue = new Queue("https://sqs.amazon.com/39857/urs", $sqsAdapter);
$queue->send("message", toSQS(["delay" => 20]));

function toSQS(array options = []) {
    $opts = [];
    if (array_key_exists("delay", $options)) {
        $opts["DelaySeconds"] = $options["delay"];
    }
    return $opts;
}
```

