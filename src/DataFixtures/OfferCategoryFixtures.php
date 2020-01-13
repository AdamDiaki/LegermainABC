<?php

namespace App\DataFixtures;

use App\Entity\OfferType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class OfferCategoryFixtures
 * @package App\DataFixtures
 */
class OfferCategoryFixtures extends Fixture
{
    /**
     * Permet d'ajouter les différents type d'offres
     * @param ObjectManager $manager
     */
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
