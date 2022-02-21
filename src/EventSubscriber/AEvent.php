<?php

namespace App\EventSubscriber;

use App\Entity\A;
use Symfony\Contracts\EventDispatcher\Event;

class AEvent extends  Event
{
    public const NAME = 'a.placed';
    public const NAME2 = 'a2.placed';


    protected $a;

    public function __construct(A $a)
    {
        $this->a = $a;
    }

    public function getA(): A
    {
        return $this->a;
    }
}