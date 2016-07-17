<?php

/**
 * Created by PhpStorm.
 * User: vanbrabantwesley
 * Date: 13/07/16
 * Time: 00:30
 */

// src/AppBundle/DataFixtures/ORM/LoadAchievementsData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Achievement;
use Faker\Factory as Faker;

class LoadAchievementData implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        $achievements = new Achievement();
        $achievements->setTitle("cool title");
        $achievements->setBody("cool body");
        $achievements->setImage("");
        $achievements->setImageFile();


        $em->persist($achievements);
        $em->flush();

    }
}