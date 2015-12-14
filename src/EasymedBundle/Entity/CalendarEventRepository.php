<?php

namespace EasymedBundle\Entity;

class CalendarEventRepository
{
    public function getVacationsBetween($start, $end)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.startDate >= :start')
            ->andWhere('c.endDate <= :end')
            ->setParameters([
                'start' => $start,
                'end' => $end
            ]);

        return $qb->getQuery()->getResult();
    }
}