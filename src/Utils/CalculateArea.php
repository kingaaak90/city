<?php

namespace App\Utils;

use App\Repository\Developer\AbstractRoomRepository;

class CalculateArea
{
    private $abstractRoomRepository;

    public function __construct(AbstractRoomRepository $abstractRoomRepository) {
        $this->abstractRoomRepository = $abstractRoomRepository;
    }

    public function calculateAllArea()
    {
        $allArea = 0;

        $areas = $this->abstractRoomRepository->getArea();

        foreach ($areas as $area) {
            $allArea += $area->getArea();
        }

        return $allArea;
    }
}