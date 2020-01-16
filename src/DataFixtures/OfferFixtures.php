<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use App\Entity\OfferType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 * Class OfferFixtures
 * @package App\DataFixtures
 */
class OfferFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {

        $info = array('CDI', 'CDD', 'STAGE', 'ALTERNANCE');
        $faker = Faker\Factory::create();


        foreach ($info as $value) {
            $cat = new OfferType();
            $cat->setTitle( $value );
            $manager->persist( $cat );

            for ($i = 1; $i <= 2; $i++) {
                $offer = new Offer();
                $offer->setBeginAt( new \DateTime( 'now' ) );
                $offer->setTitle( $faker->sentence( $nbWords = 2, $variableNbWords = true ) );
                $offer->setHourlyWage( $faker->numberBetween( $min = 10, $max = 15 ) );
                $offer->setContent( $faker->sentence( $nbWords = 250, $variableNbWords = true ) );
                $offer->setEndAt( new \DateTime( 'now' ) );
                $offer->setAddress( $faker->address );

                $offer->setOfferType( $cat );
                $manager->persist( $offer );

            }
        }


        // $product = new Product();
        // $manager->persist($product);


        $manager->flush();


    }
}
