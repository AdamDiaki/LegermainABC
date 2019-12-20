<?php

namespace App\DataFixtures;

use App\Entity\OfferType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class OfferCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $info = array('CDI','CDD','STAGE','ALTERNANCE');


        foreach ($info as $value){
            $cat = new OfferType();
            $cat->setTitle($value);
            $manager->persist($cat);
        }

        $manager->flush();
    }
}
