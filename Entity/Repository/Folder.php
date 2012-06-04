<?php

namespace Soloist\Bundle\MediaBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class Folder extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this
            ->createQueryBuilder('f')
            ->orderBy('f.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
