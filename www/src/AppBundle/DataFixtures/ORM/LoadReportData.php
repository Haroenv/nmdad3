<?php
/**
 * Created by PhpStorm.
 * User: vanbrabantwesley
 * Date: 13/07/16
 * Time: 16:53
 */


// src/AppBundle/DataFixtures/ORM/LoadReportData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Report;

class LoadReportData implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        $report = new Report();
        $report->setBody('this is a report');
        $report->setImage("cool");
        $report->setCity("Ghent");
        $report->setLatitude("5.12345");
        $report->setLongitude("5.12345");
        $report->setPostalcode("9000");
        $report->setType("some");

        $em->persist($report);
        $em->flush();
    }
}