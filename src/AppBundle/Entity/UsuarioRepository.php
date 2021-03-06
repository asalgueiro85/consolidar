<?php

namespace AppBundle\Entity;

/**
 * UsuarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsuarioRepository extends \Doctrine\ORM\EntityRepository
{
    public function countUsuarios(){
        $em = $this->getEntityManager();
        $query = $em->createQueryBuilder()
            ->select("COUNT(e)")
            ->from("AppBundle:Usuario","e")
            ->getQuery()
            ->getSingleScalarResult();

        return $query;
    }
}
