<?php

namespace App\EntityListeners;

use App\Entity\A;
use Doctrine\Persistence\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\LifecycleEventArgs;


class AListener
{
//    public function preUpdate(A $a, PreUpdateEventArgs $args): void
//    {
//        $changeSet = $args->getEntityChangeSet();
//    }
//
//    public function postUpdate(A $a, LifecycleEventArgs $args): void
//    {
//        $em = $args->getEntityManager();
//        $uow = $em->getUnitOfWork();
//
//        $changeSet = $uow->getEntityChangeSet($a);
//    }
}