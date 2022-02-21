<?php
namespace App\EventListener;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;

class JmsAutoTypeDeserializationSubscriber implements SubscribingHandlerInterface
{

    public static function getSubscribingMethods()
    {
        return array(
            array(
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'autoType',
                'method' => 'deserialize',
            ),
        );
    }

    public function deserialize(JsonDeserializationVisitor $visitor, $value, array $type, Context $context)
    {
        return $value;
    }

}