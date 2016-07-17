<?php
/**
 * Created by PhpStorm.
 * User: vanbrabantwesley
 * Date: 13/07/16
 * Time: 16:50
 */

// src/AppBundle/DataFixtures/ORM/LoadStatusData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Status;

class LoadStatusData implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        $userAdmin = new Status();
        $userAdmin->setTitle('Ready');
        $userAdmin->setBody('Test status for ready');

        $em->persist($userAdmin);
        $em->flush();
    }
}