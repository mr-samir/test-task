<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Advertising;

class AdvFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $adv = new Advertising;
        $adv->setSlotName('​/6355419/Travel/Europe/France/Paris');
        $adv->setSlotElementId('banner1');
        $adv->setSlotSizes('[300, 250]');
        $adv->setIsAvailable(false);
        $adv->setIsLazy(false);
        $manager->persist($adv);

        $manager->flush();
    }
}
