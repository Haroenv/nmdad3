<?php

/**
 * Created by PhpStorm.
 * User: vanbrabantwesley
 * Date: 13/07/16
 * Time: 00:30
 */

// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPlainPassword('test');
        $userAdmin->setEmail('just@email.com');
        $userAdmin->setLastName('lastname');
        $userAdmin->setFirstName('firstname');
        $userAdmin->addRole('ROLE_ADMIN');
        $userAdmin->setEnabled(true);

        $manager->persist($userAdmin);
        $manager->flush();

    }
}