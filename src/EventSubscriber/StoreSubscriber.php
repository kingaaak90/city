<?php

namespace App\EventSubscriber;

use App\EventSubscriber\AEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class StoreSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [AEvent::NAME => 'hej',
            AEvent::NAME2=>'ej'];
    }

    public function hej(AEvent $event)
    {
        $event->getA()->setAmount(100000);
        dump('test event');
        echo "hej";
    }

    public function ej(AEvent $event)
    {
        $event->getA()->setDate(2020-12-31);
        dump('test event2');
        echo "ej";
    }

}